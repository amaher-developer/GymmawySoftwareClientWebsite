<?php

namespace Modules\Demo\Http\Controllers\Front;

use Modules\Demo\Http\Controllers\Front\GenericFrontController;
use Modules\Demo\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

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

        return view('demo::Front.layouts.home', compact( 'title', 'activities', 'memberships', 'images', 'system_images', 'client_images'));
    }


    public function about()
    {
        return view('demo::Front.pages.about', [
            'title' => trans('global.about_us'),
            'about' => $this->mainSettings->about
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





}
