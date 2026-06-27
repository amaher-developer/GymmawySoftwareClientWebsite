<?php

namespace Modules\Fitdose\app\Http\Controllers\Front;

use Modules\Access\Models\User;
use Modules\Fitdose\app\Http\Controllers\Front\GenericFrontController;
use Modules\Fitdose\app\Http\Requests\ContactRequest;
use Modules\Fitdose\Models\Activity;
use Modules\Fitdose\Models\City;
use Modules\Fitdose\Models\Contact;
use Modules\Fitdose\Models\District;
use Modules\Fitdose\Models\Feedback;
use Modules\Fitdose\Models\PTSubscription;
use Modules\Fitdose\Models\Setting;
use Modules\Fitdose\Models\Banner;
use Modules\Fitdose\Models\Store;
use Modules\Fitdose\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Thujohn\Rss\Rss;

class MainFrontController extends GenericFrontController
{
    public function __construct()
    {
        parent::__construct();
        
    }


    public function setBranch($branchId)
    {
        $branchId = (int) $branchId;
        $branch   = Setting::find($branchId);
        if ($branch) {
            request()->session()->put('selected_branch_id', $branchId);
            \Illuminate\Support\Facades\Cookie::queue('selected_branch_id', $branchId, 43200);
        }
        // Put branch ID directly in the redirect URL so the constructor reads it
        // from ?branch= even if session/cookie are not yet available
        return redirect(route('home') . '?branch=' . $branchId);
    }

    public function index()
    {
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);

        $branchId = $this->mainSettings->id;
        $record = $this->mainSettings;
        $title = @$record->name;
        $lang = $this->lang;
        $cover_images = Banner::where("title", "!=", "schedule_banner")
            ->where('is_web', true)
            ->where('branch_setting_id', $branchId)
            ->limit(5)->get()->pluck('image');
        // Fall back to any banners if none for this branch
        if ($cover_images->isEmpty()) {
            $cover_images = Banner::where("title", "!=", "schedule_banner")->where('is_web', true)->limit(5)->get()->pluck('image');
        }
        $images = (array)$record['images'];
        $subscriptions = Subscription::where('is_web', true)
            ->where('branch_setting_id', $branchId)
            ->orderBy('id', 'desc')->get();
        $activities = Activity::where('is_web', true)
            ->where('branch_setting_id', $branchId)
            ->orderBy('id', 'desc')->get();
        $stores = Store::where('is_web', true)->orderBy('id', 'desc')->get();
        return view('fitdose::Front.layouts.home', compact('title', 'record', 'lang', 'cover_images', 'images', 'subscriptions', 'activities', 'stores'));
    }





    public function about()
    {
        return view('fitdose::Front.pages.about', [
            'title' => trans('global.about_us'),
            'about' => $this->mainSettings->about
        ]);
    }

    public function terms()
    {
        return view('fitdose::Front.pages.terms', [
            'title' => trans('global.terms'),
            'terms' => $this->mainSettings->terms
        ]);
    }

    public function policy()
    {
        return view('fitdose::Front.pages.policy', [
            'title' => trans('global.policy'),
            'policy' => $this->mainSettings->policy
        ]);
    }

    public function refund()
    {
        return view('fitdose::Front.pages.refund', [
            'title' => trans('front.refund_policy'),
        ]);
    }

    public function contactCreate()
    {

        return view('fitdose::Front.pages.contact', [
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
//            $user = GymUser::create(['image' => 'gymmawy.png', 'permissions' => [], 'title' => 'مدير', 'is_super_user' => 1, 'password' => $data['password'], 'phone' => $data['phone'], 'name' => $data['name'], 'email' => $data['email']]);
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
        return view('fitdose::Front.pages.thanks', [
            'title' => trans('global.thank_you')]);
    }

    public function home()
    {

        return view('fitdose::Front.user.home', [
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

    public function smartLink()
    {
        $userAgent = request()->header('User-Agent', '');
        $settings = Setting::first();

        if (preg_match('/iPhone|iPad|iPod/i', $userAgent) && !empty($settings->ios_app)) {
            return redirect()->away($settings->ios_app);
        }

        if (preg_match('/Android/i', $userAgent) && !empty($settings->android_app)) {
            return redirect()->away($settings->android_app);
        }

        return redirect()->to(env('APP_URL'));
    }

    public function downloadApp()
    {
        $settings = $this->mainSettings;
        $smartLinkUrl = url('/go');
        $qrCode = QrCode::size(300)->generate($smartLinkUrl);

        return view('fitdose::Front.pages.download_app', [
            'title' => $this->lang == 'ar' ? 'تحميل التطبيق' : 'Download App',
            'qrCode' => $qrCode,
            'smartLinkUrl' => $smartLinkUrl,
            'iosApp' => $settings->ios_app ?? '',
            'androidApp' => $settings->android_app ?? '',
        ]);
    }

    public function test(){
        $sms = new SMSEG();
        $sms = $sms->getBalance();
        dd($sms);
    }

}
