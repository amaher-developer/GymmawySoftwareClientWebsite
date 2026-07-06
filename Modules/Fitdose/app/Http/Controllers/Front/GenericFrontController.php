<?php

namespace Modules\Fitdose\app\Http\Controllers\Front;

use App\Http\Requests;
use Modules\Fitdose\app\Http\Controllers\GenericController;
use Modules\Fitdose\Models\Setting;
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
    public $currentBranch;
    public $allBranches;
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

        // Load all branches (all settings rows)
        $this->allBranches = Setting::all();
        foreach ($this->allBranches as $branch) {
            $branch->lang = $this->lang;
        }

        // --- Branch resolution: URL param wins, then session, then cookie ---
        // 1. URL query param  (?branch=21)  — appended to current URL by auto-sync JS
        $urlBranch = request()->query('branch') ? (int) request()->query('branch') : null;

        // 2. Session
        $sessionBranch = request()->hasSession()
            ? (int) request()->session()->get('selected_branch_id')
            : null;

        // 3. Laravel encrypted cookie (set by Cookie::queue)
        $cookieRaw    = request()->cookie('selected_branch_id');
        $cookieBranch = $cookieRaw ? (int) $cookieRaw : null;

        // 4. Plain browser cookie written by JS (not encrypted – always readable)
        $jsCookieBranch = isset($_COOKIE['fitdose_branch_id']) ? (int) $_COOKIE['fitdose_branch_id'] : null;

        $selectedBranchId = $urlBranch ?: $sessionBranch ?: $cookieBranch ?: $jsCookieBranch ?: null;

        \Illuminate\Support\Facades\Log::info('BRANCH_DEBUG', [
            'path' => request()->path(),
            'urlBranch' => $urlBranch,
            'sessionBranch' => $sessionBranch,
            'cookieRaw' => $cookieRaw,
            'cookieBranch' => $cookieBranch,
            'jsCookieBranch' => $jsCookieBranch,
            'selectedBranchId' => $selectedBranchId,
            'hasSession' => request()->hasSession(),
            'sessionId' => request()->hasSession() ? request()->session()->getId() : null,
        ]);

        // Always write the resolved branch back to session + cookie so it survives navigation
        if ($selectedBranchId && request()->hasSession()) {
            request()->session()->put('selected_branch_id', $selectedBranchId);
        }

        if ($selectedBranchId) {
            $this->currentBranch = $this->allBranches->find($selectedBranchId);
        }

        // Fall back to null (will show modal) if none selected or not found
        if (!$this->currentBranch && $this->allBranches->count() === 1) {
            $this->currentBranch = $this->allBranches->first();
            $selectedBranchId = $this->currentBranch->id;
        }

        // Use first branch as default for layout rendering; modal will appear
        if (!$this->currentBranch) {
            $this->currentBranch = $this->allBranches->first();
        }

        $this->mainSettings = $this->currentBranch;

        // Set the language on the mainSettings object for proper localization
        $this->mainSettings->lang = $this->lang;

        View::share('mainSettings', $this->mainSettings);
        View::share('allBranches', $this->allBranches);
        View::share('selectedBranchId', $selectedBranchId);
        View::share('lang', $this->lang);
        View::share('template_version', env('TEMPLATE_NUM', ''));
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
