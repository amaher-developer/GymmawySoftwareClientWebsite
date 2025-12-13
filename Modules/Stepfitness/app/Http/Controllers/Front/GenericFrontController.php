<?php

namespace Modules\Stepfitness\app\Http\Controllers\Front;

use App\Http\Requests;
use Modules\Stepfitness\app\Http\Controllers\GenericController;
use Modules\Stepfitness\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class GenericFrontController extends GenericController
{
    public $lang;
    public $user;
    public $current_user;
    public $master_url;
    public $SettingRepository;
    public $mainSettings;
    public $cities;
    public $districts;
    public $limit;
    public $changeLang;

    public function __construct()
    {
        parent::__construct();
        $this->master_url = @env('APP_URL_MASTER');
        $this->changeLang = Cache::store('file')->get('changeLang');
        if($this->changeLang != request()->segment(1)){
            Cache::store('file')->clear();
            Cache::store('file')->put('changeLang', request()->segment(1), 600);
        }

        if (request()->segment(1) != 'ar' && request()->segment(1) != 'en') {
            $this->lang = 'ar';
            if (request()->hasSession()) {
                request()->session()->put('lang', 'ar');
                app()->setLocale(request()->session()->get('lang'));
            } else {
                app()->setLocale('ar');
            }
            $this->clearWebsiteCache();
        } else {
            $this->lang = request()->segment(1);
            if (request()->hasSession()) {
                request()->session()->put('lang', $this->lang);
                app()->setLocale($this->lang);
            } else {
                app()->setLocale($this->lang);
            }
            
            $this->clearWebsiteCache();
        }
        $this->limit = 10;

        $this->mainSettings = Cache::store('file')->get('mainSettings');
        if (!$this->mainSettings) {
//            $this->mainSettings = (array)@$this->getWebInfo()->settings;
            $this->mainSettings = Setting::first();
            Cache::store('file')->put('mainSettings',$this->mainSettings, 600 );
        }

        // Set the language on the mainSettings object for proper localization
        $this->mainSettings->lang = $this->lang;

        View::share('mainSettings', $this->mainSettings);
        View::share('lang', $this->lang);
        View::share('template_version', env('TEMPLATE_NUM', ''));

//        $this->user = @Auth::user();
        $this->current_user = request()->hasSession() ? request()->session()->get('user') : null;
        View::share('currentUser',$this->current_user);
    }

    public function clearWebsiteCache(){
        Cache::store('file')->clear();
        return redirect()->route('home');
    }
    protected function getWebInfo(){
        $ch = curl_init();
        $certificate_location = "";
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $certificate_location);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $certificate_location);
        $options = array(
            CURLOPT_URL            => $this->master_url."api/settings",
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode(array(
                'lang' => $this->lang
            )),
            CURLOPT_RETURNTRANSFER => true
        );

        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return (@$result);
    }

    public function falseReturn($error_ar = '', $error_en = '')
    {
        return redirect()->back()->withErrors(['error' => ($this->lang == 'en' ? $error_en : $error_ar)]);
    }

    protected function validateFrontFields($required = [], $array_data = [])
    {

        $missing = [];
        foreach ($required as $item) {
            if (!key_exists($item, $array_data) || $array_data[$item] == '') $missing[] = $item;
        }
        if ($missing) {
            return 'missing ' . implode(', ', $missing);
        }
        return TRUE;
    }
    protected function validateFrontRequest($required = [])
    {

        $missing = [];
//        $required[] = 'device_type';
        foreach ($required as $item) {
            $input = request($item);
            if ((!isset($input)) || $input == '') $missing[] = $item;
        }
        if ($missing) {
            return 'missing ' . implode(', ', $missing);
        }
        return TRUE;


    }
}
