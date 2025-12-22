<?php

namespace App\Modules\Cakorinas\app\Http\Controllers\Front;

use App\Modules\Access\Models\User;

use App\Modules\Cakorinas\app\Http\Requests\ContactRequest;
use App\Modules\Cakorinas\app\Models\Activity;
use App\Modules\Cakorinas\app\Models\Banner;
use App\Modules\Cakorinas\app\Models\PTClass;
use App\Modules\Cakorinas\app\Models\PTSubscription;
use App\Modules\Cakorinas\app\Models\Setting;

use App\Modules\Cakorinas\app\Models\Store;
use App\Modules\Cakorinas\app\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;


class MainFrontController extends GenericFrontController
{


    public $video_banner;

    public function __construct()
    {
        $this->video_banner = '';
        parent::__construct();
    }


    public function index()
    {        
        View::share('currentUser', @request()->session()->get('user'));
        $record = $this->mainSettings;
        $title = $record['name'];
        $lang = $this->lang;
        $banners = Banner::where("title", "!=", "schedule_banner")->where('is_web', true)->limit(5)->get()->pluck('image');
        $schedule_banner = Banner::where('is_web', true)->where('title', 'schedule_banner')->first();
        $images = (array)$record['images'];
        $subscriptions = Subscription::where('is_web', true)->orderBy('id', 'desc')->get();
        $activities = Activity::where('is_web', true)->orderBy('id', 'desc')->get();
        $pt_classes = PTClass::where('is_web', true)->orderBy('id', 'desc')->get();
        $stores = Store::where('is_web', true)->orderBy('id', 'desc')->get();
        return view('cakorinas::Front.layouts.home', compact('title', 'record', 'schedule_banner', 'lang', 'banners', 'images', 'subscriptions', 'activities', 'stores', 'pt_classes'));
    }
    public function banner(){

        $title = trans('front.schedule_banner');
        $lang = $this->lang;
        $banner = Banner::where('is_web', true)->where('title', 'schedule_banner')->first();
        return view('cakorinas::Front.pages.banner', compact('title', 'banner', 'lang'));

    }


    private function youtube_id($url){
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );

        return @$my_array_of_vars['v'];
    }


    public function about()
    {
        return view('cakorinas::Front.pages.about', [
            'title' => trans('global.about_us'),
            'about' => $this->mainSettings->about
        ]);
    }

    public function terms()
    {
        return view('cakorinas::Front.pages.terms', [
            'title' => trans('global.terms'),
            'terms' => $this->mainSettings->terms
        ]);
    }



    public function contactCreate()
    {

        return view('cakorinas::Front.pages.contact', [
            'title' => trans('global.contact'),
            'about' => $this->mainSettings->about
        ]);
    }

    /**
     * @return string
     */
    public function contactStore()
    {
        $name = @$request->name;
        $message = @$request->message;
        $email = @$request->email;
        $setting = $this->mainSettings;
        //Contact::create(request()->all());

        $data = array(
            'name' => $name
        , 'email' => $email
        , 'msg' => $message
        );

//        Mail::send('emails.contact_us', $data, function ($message) use ($data, $setting) {
//            $message->from($data['email'], $data['name']);
//            $message->to($setting->support_email, trans('global.contact_us'))->subject(trans('global.contact_us'));
//        });
        Mail::send('emails.contact_us', $data, function ($message) use ($data, $setting) {
            $message->from($data['email'], $data['name']);
            $message->to('eng.a7med.ma7er@gmail.com', @env('APP_NAME_AR')." ".trans('global.contact_us'))->subject(trans('global.contact_us'));
        });
        return 1;
//        $data['type'] = 1;
//        Contact::create($data);
//        \mail('eng.a7med.ma7er@gmail.com', 'new contact for gymmawy', implode(', ', $data));
//        $data['password'] = rand(1000, 9999);
//        $user = GymUser::where('email' , $data['email'])->orWhere('phone' , $data['phone'])->first();
//        if($user->id != 1) {
//            if ($user) {
//                $user->delete();
//            }
//            $user = GymUser::create(['image' => 'gymmawy.png', 'permissions' => [], 'title' => 'Ù…Ø¯ÙŠØ±', 'is_super_user' => 1, 'password' => $data['password'], 'phone' => $data['phone'], 'name' => $data['name'], 'email' => $data['email']]);
//        }
//
//        $qrcodes_folder = base_path('uploads/qrcodes/');
//        $d = new DNS1D();
//        $d->setStorPath($qrcodes_folder);
//        $data['code'] = asset($d->getBarcodePNGPath($user['id'], TypeConstants::BarcodeType));
//
//        $data['settings'] = $setting;
//        $data['data'] = $data;
//
//
//        Mail::send('emails.software_member_demo_info', $data, function ($message) use ($data, $setting) {
//            $message->from($setting->support_email, $setting['name_'.$this->lang]);
//            $message->to($data['email'], trans('front.demo_info'))->subject(trans('front.demo_info'));
//        });


        return redirect()->route('thanks');

    }

    public function newsletter(Request $request)
    {
        $email = $request->email;
        //Contact::create(request()->all());
        if (!$email)
            return false;

        Newsletter::updateOrCreate(['email' => $email], ['email' => $email]);
        return true;

    }

    public function feedbackStore(Request $request)
    {
        if ($request->feedback)
            Feedback::create(['feedback' => $request->feedback, 'user_id' => Auth::user()->id]);

        sweet_alert()->success(trans('admin.done'), trans('admin.successfully_added'));
        return redirect()->back();
    }

    public function thanks()
    {
        return view('cakorinas::Front.pages.thanks', [
            'title' => trans('global.thank_you')]);
    }

    public function home()
    {

        return view('cakorinas::Front.user.home', [
            'title' => trans('global.home'),
        ]);
    }

    public function wa()
    {
        if($this->mainSettings->phone)
            return redirect()->away('https://wa.me/'.$this->mainSettings->phone);

        return redirect()->route('home');
    }
    public function searchRedirect(Request $request)
    {
        if ($request->get('type') == 2) {
            return redirect()->route('trainers', ['district' => $request->get('district'), 'city' => $request->get('city')]);
        } else {
            return redirect()->route('gyms', ['district' => $request->get('district'), 'city' => $request->get('city')]);
        }
    }




    function sitemap()
    {
        $a = '';

        $a .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url>
                <loc>'.env('APP_URL').'</loc>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
                </url>';

            $a .= '<url>
        <loc>'.env('APP_URL').'/' . '</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
        </url>';


        $a.= '</urlset>';

        $f = fopen(public_path('sitemap.xml'), 'w');
        fwrite($f, $a);
        fclose($f);


    }

    public function site_on(){
        $setting = Setting::first();
        $setting->under_maintenance = 0;
        $setting->save();
        return 1;
    }
    public function site_off(){
        $setting = Setting::first();
        $setting->under_maintenance = 1;
        $setting->save();
        return 1;
    }

    public function test(){
        $sms = new SMSEG();
        $sms = $sms->getBalance();
        dd($sms);
    }

}


