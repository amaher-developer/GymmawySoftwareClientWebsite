<?php

namespace Modules\Zonegym\Http\Controllers\Front;

use App\Modules\Access\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Modules\Zonegym\Http\Controllers\GenericController;
use Modules\Zonegym\Http\Requests\ContactRequest;
use Modules\Zonegym\Models\Activity;
use Modules\Zonegym\Models\Banner;
use Modules\Zonegym\Models\City;
use Modules\Zonegym\Models\Contact;
use Modules\Zonegym\Models\District;
use Modules\Zonegym\Models\Feedback;
use Modules\Zonegym\Models\PTSubscription;
use Modules\Zonegym\Models\Setting;
use Modules\Zonegym\Models\Store;
use Modules\Zonegym\Models\Subscription;
use Thujohn\Rss\Rss;

class MainFrontController extends GenericFrontController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $record = $this->mainSettings;
        $title = $record['name'];
        $lang = $this->lang;
        $cover_images = Banner::select('image')->where('is_web', true)->get()->pluck('image');
        $images = (array)$record['images'];
        $subscriptions = Subscription::where('is_web', true)->get();
        $activities = Activity::where('is_web', true)->get();
//        $pt_subscriptions = PTSubscription::where('is_web', true)->get();
        $stores = Store::where('is_web', true)->get();
        return view('zonegym::Front.layouts.home', compact('title', 'record', 'lang', 'cover_images', 'images', 'subscriptions', 'activities', 'stores'));
    }





    public function about()
    {
        return view('zonegym::Front.pages.about', [
            'title' => trans('global.about_us'),
            'about' => $this->mainSettings->about
        ]);
    }



    public function contactCreate()
    {

        return view('zonegym::Front.pages.contact', [
            'title' => trans('global.contact'),
            'about' => $this->mainSettings->about
        ]);
    }

    /**
     * @return string
     */
    public function contactStore(ContactRequest $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $country = $request->country;
        $email = $request->email;
        $setting = $this->mainSettings;
        //Contact::create(request()->all());

        $data = array(
            'name' => $name
        , 'phone' => $phone
        , 'email' => $email
        , 'country' => $country
        );

        Mail::send('emails.contact_us', $data, function ($message) use ($data, $setting) {
            $message->from($data['email'], $data['name']);
            $message->to($setting->support_email, trans('global.contact_us'))->subject(trans('global.contact_us'));
        });
        Mail::send('emails.contact_us', $data, function ($message) use ($data, $setting) {
            $message->from($data['email'], $data['name']);
            $message->to('eng.a7med.ma7er@gmail.com', env('APP_NAME_AR')." ".trans('global.contact_us'))->subject(trans('global.contact_us'));
        });
        $data['type'] = 1;
        Contact::create($data);
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
        return view('zonegym::Front.pages.thanks', [
            'title' => trans('global.thank_you')]);
    }

    public function home()
    {

        return view('zonegym::Front.user.home', [
            'title' => trans('global.home'),
        ]);
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
