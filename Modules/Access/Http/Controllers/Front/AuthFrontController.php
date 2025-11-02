<?php

namespace App\Modules\Access\Http\Controllers\Front;

use App\Modules\Access\Http\Requests\RegisterRequest;
use App\Modules\Access\Models\User;
use App\Modules\Access\Models\UserVisitedDistrict;
use App\Modules\Generic\Http\Controllers\Front\GenericFrontController;
use App\Modules\Generic\Http\enums\MailType;
use App\Modules\Item\Http\enums\ItemStatus;
use App\Modules\Item\Http\enums\OfferStatus;
use App\Modules\Item\Models\Item;
use App\Modules\Item\Models\Offer;
use App\Modules\Location\Models\District;
use App\Modules\Mailchimp\Http\Controllers\Admin\MailchimpAdminController;
use App\Modules\Notification\Models\NewsletterSubscriber;
use App\Modules\SmsGateway\Http\Controllers\Admin\SMSGatewayAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class AuthFrontController extends GenericFrontController
{
    private $social_types = ['facebook' => 'facebook_id', 'twitter' => 'twitter_id', 'google' => 'google_id'];

    /**
     * AuthFrontController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
        $this->middleware('auth', ['only' => ['editProfile', 'updateProfile']]);
    }

    public function getLogout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        $user = \session('social_user') ? \session('social_user') : [];
        $is_exists = @User::Where('email', $user['email'])->first();
        if($is_exists){
            Auth::login($is_exists);
            \session()->forget('social_user');
            return redirect(route('dashboard'));
        }
        return view('access::Front.register', [
            'title' => trans('global.register'),
            'user' => $user
        ]);
    }

    /**
     * @param RegisterRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        $social_user = \session('social_user');
        $user_arr = $request->except(['_token', 'newsletter_subscribe','password_confirmation']);
        $is_exists = User::Where('email', $user_arr['email'])->first();
        if ($is_exists && !$social_user) {
            return redirect()->back()->withErrors(['error' => trans('global.email_already_exists')]);
        } else {
            $token = str_random(40) . time();
            $user_arr['register_token'] = $token;
            $user = User::create($user_arr);

            if($social_user['email'] == $user_arr['email']){
                $user->activated = 1;
                $user->save();
                Auth::attempt(['email' => $user_arr['email'], 'password' => $user_arr['password']]);
            }

            // send email with password
            @sendMail('user_activation',$user->email, trans('global.new_register'), ['token' => $token, 'name' => $user->name]);

            \session()->forget('social_user');
            return redirect(route('thanksRegister'));
        }
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            //unset($_COOKIE['user_id']);
            //setcookie('user_id', $user['id'], time() + (86400 * 30) , "/");
            return redirect()->route('home');
        } else {
            $record = $this->mainSettings;
            $title = $record['name'];
            $lang = $this->lang;
            $record['cover_images'] = (array)$record['cover_images'];

            return view('access::Front.login', compact('title', 'record', 'lang'));

        }
    }


    public function login(Request $request)
    {
        $user = '';
        $this->validate($request, ['phone' => 'required', 'code' => 'required']);
        $credentials = $request->only(['phone', 'code']);
        if ($credentials['code'] && $credentials['phone']) {
            $user = $this->getSubscriptionInfo($credentials['code'] , $credentials['phone']);
            request()->session()->put('user', @$user->member);
        }

        if (!@$user->member){
            \Session::flash('error', trans('auth.failed'));
            return redirect()->back();
        }
        if (@$user->member)
            return redirect()->route('showProfile');
        else{
            \Session::flash('error', trans('auth.failed'));
            return redirect()->back();
        }

    }

    public function getSubscriptionInfo($code , $phone, $url = 'api/member-subscription-info'){
        $url = $this->master_url.$url;
        $ch = curl_init();
        $certificate_location = "";
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $certificate_location);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate_location);
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode(array(
                'lang' => $this->lang,
                "phone" => $phone,
                "code" => $code
            )),
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return (@$result);
    }
    public function redirectToProvider()
    {
        session(['social_provider' => request('provider')]);
        return Socialite::driver(request('provider'))->redirect();
    }



    public function showUser()
    {
        $title = trans('admin.my_info');
        $user = Auth::user();
        return view('access::Front.user.user_front_view', ['title' => $title, 'user' => $user]);
    }



    public function handleProviderCallback()
    {
        if (request()->input('error')) {
            return redirect()->route('home')->withErrors(['error' => trans('global.access_denied')]);
        } else {
//            Socialite::driver(session('social_provider'))->stateless();
            $social_user = Socialite::driver(session('social_provider'))->stateless()->user();
            $social_type = $this->social_types[session('social_provider')];
            if ($user = User::where([$social_type => $social_user->id])->first()) {
                Auth::login($user);
                //unset($_COOKIE['user_id']);
                //setcookie('user_id', $user['id'], time() + (86400 * 30) , "/");
                request()->session()->remove('currentArea');
                return redirect()->route('home');
            }
            session(['social_user' => $social_user, 'social_type' => $social_type]);
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }

    public function showProfile()
    {
        if(!$this->current_user)
            return redirect()->route('login');
        return view('access::Front.show_profile');
    }


    public function editProfile()
    {
        return view('access::Front.edit_profile');
    }

    public function updateProfile(Request $request)
    {
        if (!empty($this->user)) {
            if ($this->user->phone == request('phone')) {
                $inputs = $inputs_ = $request->only(['password', 'name', 'phone']);
                foreach ($inputs_ as $key => $input) {
                    if (empty($input))
                        unset($inputs[$key]);
                }
                Auth::User()->update($inputs);
                request()->session()->flash('success', trans('global.profile_updated_successfully'));
                return redirect()->back();
            } else {

                $phone_exist = User::where('phone', request('phone'))->value('phone');

                if (!$phone_exist) {

                    $inputs = $inputs_ = $request->only(['password', 'email', 'name', 'phone']);
                    foreach ($inputs_ as $key => $input) {
                        if (empty($input))
                            unset($inputs[$key]);
                    }
                    /** @var Address $address */
                    $inputs['verified'] = 0;
                    Auth::User()->update($inputs);
                    Offer::where('user_id', $this->user->id)->whereIn('status', [OfferStatus::delivered, OfferStatus::seen])
                        ->update(['status' => OfferStatus::waiting_for_mobile_verification]);
                    Item::where('user_id', $this->user->id)->whereIn('status', [ItemStatus::not_approved, ItemStatus::approved])
                        ->update(['status' => ItemStatus::waiting_for_mobile_verification]);
                    request()->session()->flash('success', trans('global.profile_updated_successfully'));
                    return redirect()->back();
                } else {
                    return $this->falseReturn('رقم التليفون موجود.', 'Mobile Already Exists.');
                }
            }
        } else {
            return $this->falseReturn('المستخدم غير موجود', 'User Not Found');
        }
    }



    private function prepare_inputs($inputs)
    {
        $input_file = 'image';
        $uploaded='';

        $destinationPath = base_path(User::$uploads_path);
        $ThumbnailsDestinationPath = base_path(User::$thumbnails_uploads_path);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }
        if (!File::exists($ThumbnailsDestinationPath)) {
            File::makeDirectory($ThumbnailsDestinationPath, $mode = 0777, true, true);
        }
        if (request()->hasFile($input_file)) {
            $file = request()->file($input_file);

            if (is_image($file->getRealPath())) {
                $filename = rand(0, 20000) . time() . '.' . $file->getClientOriginalExtension();


                $uploaded = $filename;

                $img = Image::make($file);
                $original_width = $img->width();
                $original_height = $img->height();

                if ($original_width > 1200 || $original_height > 900) {
                    if ($original_width < $original_height) {
                        $new_width = 1200;
                        $new_height = ceil($original_height * 900 / $original_width);
                    } else {
                        $new_height = 900;
                        $new_width = ceil($original_width * 1200 / $original_height);
                    }

                    //save used image
                    $img->encode('jpg', 90)->save($destinationPath . $filename);
                    $img->resize($new_width, $new_height, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg', 90)->save($destinationPath . '' . $filename);

                    //create thumbnail
                    if ($original_width < $original_height) {
                        $thumbnails_width = 400;
                        $thumbnails_height = ceil($new_height * 300 / $new_width);
                    } else {
                        $thumbnails_height = 300;
                        $thumbnails_width = ceil($new_width * 400 / $new_height);
                    }
                    $img->resize($thumbnails_width, $thumbnails_height, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg', 90)->save($ThumbnailsDestinationPath . '' . $filename);
                } else {
                    //save used image
                    $img->encode('jpg', 90)->save($destinationPath . $filename);
                    //create thumbnail
                    if ($original_width < $original_height) {
                        $thumbnails_width = 400;
                        $thumbnails_height = ceil($original_height * 300 / $original_width);
                    } else {
                        $thumbnails_height = 300;
                        $thumbnails_width = ceil($original_width * 400 / $original_height);
                    }
                    $img->resize($thumbnails_width, $thumbnails_height, function ($constraint) {
                        $constraint->aspectRatio();
                    })->encode('jpg', 90)->save($ThumbnailsDestinationPath . '' . $filename);
                }
                $inputs[$input_file]=$uploaded;
            }

        }


//        !$inputs['deleted_at']?$inputs['deleted_at']=null:'';

        return $inputs;
    }

    public function thanksRegister(){
        return view('access::Front.thanks_register', [
            'title' => trans('global.thank_you')]);
    }

}
