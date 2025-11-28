<?php

namespace Modules\Demo\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Modules\Demo\Http\Controllers\GenericController;
use Modules\Demo\Models\Setting;
use Stevebauman\Location\Facades\Location;

class GenericFrontController extends GenericController
{
    public $lang;
    public $user;
    public $current_gym_id;
    public $SettingRepository;
    public $mainSettings;
    public $cities;
    public $districts;
    public $limit;
    public $changeLang;
    public $request_array;
    public $ip;
    public $country;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function (Request $request, $next) {
            $this->bootstrapFrontContext($request);

            return $next($request);
        });
    }

    protected function bootstrapFrontContext(Request $request): void
    {
        $this->changeLang = Cache::store('file')->get('changeLang');
        if ($this->changeLang !== $request->segment(1)) {
            Cache::store('file')->clear();
            Cache::store('file')->put('changeLang', $request->segment(1), 600);
        }

        if (!in_array($request->segment(1), ['ar', 'en'], true)) {
            $this->lang = 'ar';
            $request->session()->put('lang', 'ar');
        } else {
            $request->session()->put('lang', $request->segment(1));
            $this->lang = $request->segment(1);
        }
        app()->setLocale($request->session()->get('lang', $this->lang));

        $this->limit = 10;

        $this->mainSettings = Cache::store('file')->get('mainSettings');
        if (!$this->mainSettings) {
            $this->mainSettings = Setting::query()->first() ?? new Setting();
            Cache::store('file')->put('mainSettings', $this->mainSettings, 600);
        }

        if ($this->lang === 'ar') {
            $this->mainSettings->name = 'جيماوي | برنامج ادارة الجيم والنوادي الرياضية';
            $this->mainSettings->meta_keywords = str_replace('&', ', ', 'برنامج لادارة نادي رياضي&برنامج ادارة الصالات الرياضية مجانا&برنامج ادارة صالة رياضية&برنامج ادارة الاندية الرياضية&برنامج ادارة الصالات الرياضية&كيفية ادارة جيم&تحميل برنامج ادارة صالات الجيم&برنامج محاسبة للاندية الرياضي&محاسبة النوادي&جيمات&مدربين&برنامج&نادي رياضي&حوض&ساونا&علاج طبيعي&جهاز بصمة&بوابه دخول وخروج&حضور وانصراف&كيفية ادارة جيم&برنامج ادارة الجيم والنوادى الخاصة برنامج الصالات والاندية الرياضية&تطبيق نادي رياضي&كيفية ادارة صالة جيم&اسعار تجهيز صالة جيم&تكلفة صالة جيم فى مصر&مشروع جيم يتكلف كام&تكلفة مشروع جيم رياضي&برنامج الصالات الرياضية&إدارة الصالات الرياضية&إدارة الجيم&دفع اليكتروني&فيزا&تابي&تمارا&مدي');
            $this->mainSettings->meta_description = 'جيماوي هو برنامج ونظام رياضي متكاملًا لإدارة الجيم ومراكز اللياقة البدنية والنوادي الصحية بواجهة سهلة الاستخدام تدعم اللغة العربية و مصمم لتسهيل الاحتفاظ بسجلات مفصلة لأعضائك وعضوياتهم ، وحجز العضويات والأنشطة ، ومعالجة المبيعات وتتبعها ، والتواصل الجماعي مع الأعضاء المناسبين في الوقت المناسب و تقديم تقارير ماليه و إداريه مفصله. صمم جيماوي خصيصا للارتقاء إداريا وتسويقيا بمستوى الصالات الرياضية عن طريق متابعة جميع أعمال الصالات الرياضية بالنظام السحابي (saas)';
        } else {
            $this->mainSettings->name = 'gymmawy | gym and sports club management software';
            $this->mainSettings->meta_keywords = str_replace('&', ', ', 'gyms&trainers&program&club&Online Billing&online invoicing software&create invoice online&Online subscription system&recurring billing&billing and invoice&invoice and billing&invoice for billing&electronic payment&Visa&Tabby&Tamara&Mada');
            $this->mainSettings->meta_description = 'gymmawy is an all-in-one software for managing gyms, fitness centers, and health clubs, easy-to-use, assistant-use, facilities, utilities, their memberships, memberships, sales processing and tracking, and timely events. Gymmawy was designed specifically to upgrade the administrative and marketing level of gyms by following up all the work of gyms in the cloud (saas).';
        }

        $this->ip = $request->ip();
        $currentUserInfo = Location::get($this->ip);
        $this->country = strtolower($currentUserInfo->countryName ?? '') ?? '';

        View::share('country_name', $this->country);
        View::share('mainSettings', $this->mainSettings);
        View::share('lang', $this->lang);

        $this->user = Auth::user();
        View::share('currentUser', $this->user);
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
//            foreach ($missing as &$var) {
//                $label = ItemTypeFieldsLabel::all[$this->lang][$var];
//                if ($label)
//                    $var = ItemTypeFieldsLabel::all[$this->lang][$var];
//            }
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
//            foreach ($missing as &$var) {
//                $label = ItemTypeFieldsLabel::all[$this->lang][$var];
//                if ($label)
//                    $var = ItemTypeFieldsLabel::all[$this->lang][$var];
//            }
            return 'missing ' . implode(', ', $missing);
        }
        return TRUE;


    }
}
