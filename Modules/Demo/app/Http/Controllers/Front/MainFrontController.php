<?php

namespace Modules\Demo\Http\Controllers\Front;

use Modules\Demo\Http\Controllers\Front\GenericFrontController;
use Modules\Demo\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Demo\Models\Contact;
use Modules\Demo\Models\Setting;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MainFrontController extends GenericFrontController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $title = env('APP_NAME_'.$this->lang);

//        $dir = ("uploads/gallery/*.jpg");
//        $images = glob( $dir );
        $dir = ("uploads/systems/*.png");
        $system_images = glob( $dir );

        $dir = ("uploads/clients/*.jpg");
        $client_images = glob( $dir );
        $client_images = array_reverse($client_images);
        $activities = [];
        $memberships = [];
        $images = [];

        // Load data from JSON files
        $testimonials = collect(json_decode(file_get_contents(module_path('Demo', 'data/testimonials.json')), true))
            ->where('active', true)
            ->sortBy('order')
            ->values();

        $faqs = collect(json_decode(file_get_contents(module_path('Demo', 'data/faqs.json')), true))
            ->where('active', true)
            ->sortBy('order')
            ->values();

        $stats = collect(json_decode(file_get_contents(module_path('Demo', 'data/stats.json')), true))
            ->where('active', true)
            ->sortBy('order')
            ->values();

        $trust_badges = collect(json_decode(file_get_contents(module_path('Demo', 'data/trust-badges.json')), true))
            ->where('active', true)
            ->sortBy('order')
            ->values();

        return view('demo::Front.layouts.home', compact( 'title', 'activities', 'memberships', 'images', 'system_images', 'client_images', 'testimonials', 'faqs', 'stats', 'trust_badges'));
    }


    public function about()
    {
        return view('demo::Front.pages.about', [
            'title' => trans('global.about_us'),
            'about' => $this->mainSettings->about
        ]);
    }

    public function terms()
    {
        return view('demo::Front.pages.terms', [
            'title' => trans('global.terms'),
            'terms' => $this->mainSettings->terms
        ]);
    }

    public function policy()
    {
        return view('demo::Front.pages.policy', [
            'title' => trans('global.policy'),
            'policy' => $this->mainSettings->policy
        ]);
    }

    public function contactCreate()
    {

        return view('demo::Front.pages.contact', [
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

//        Mail::send('emails.contact_us', $data, function ($message) use ($data, $setting) {
//            $message->from($data['email'], $data['name']);
//            $message->to($setting->support_email, trans('global.contact_us'))->subject(trans('global.contact_us'));
//        });
//        Mail::send('emails.contact_us', $data, function ($message) use ($data, $setting) {
//            $message->from($data['email'], $data['name']);
//            $message->to('eng.a7med.ma7er@gmail.com', env('APP_NAME_AR')." ".trans('global.contact_us'))->subject(trans('global.contact_us'));
//        });

        Mail::send('emails.contact_us', $data, function ($message) use ($data) {
            $message->from(config('mail.from.address'), config('mail.from.name'))
                ->replyTo($data['email'], $data['name'])
                ->to('eng.a7med.ma7er@gmail.com', env('APP_NAME_AR') . ' ' . trans('global.contact_us'))
                ->subject(trans('global.contact_us'));
        });

        $data['type'] = 1;
        Contact::create($data);


        return redirect()->route('thanks');

    }


    public function thanks()
    {
        return view('demo::Front.pages.thanks', [
            'title' => trans('global.thank_you')]);
    }

    public function home()
    {

        return view('demo::Front.user.home', [
            'title' => trans('global.home'),
        ]);
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

        return view('demo::Front.pages.download_app', [
            'title' => $this->lang == 'ar' ? 'تحميل التطبيق' : 'Download App',
            'qrCode' => $qrCode,
            'smartLinkUrl' => $smartLinkUrl,
            'iosApp' => $settings->ios_app ?? '',
            'androidApp' => $settings->android_app ?? '',
        ]);
    }

}
