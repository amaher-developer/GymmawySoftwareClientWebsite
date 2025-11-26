<?php

namespace Modules\Stepfitness\app\Http\Controllers\Admin;

use Modules\Stepfitness\app\Http\Controllers\Admin\GenericAdminController;
use Modules\Stepfitness\app\Http\Requests\SettingRequest;
use App\Http\Controllers\Controller;
use Modules\Stepfitness\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingAdminController extends GenericAdminController
{

    public function edit()
    {
        $title = 'Update Content';
        return view('stepfitness::Admin.setting_admin_form', ['title'=>$title]);
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $setting_inputs = $this->prepare_inputs($request->except(['_token']));
       $setting->update($setting_inputs);
        Cache::store('file')->clear();
        sweet_alert()->success('Done', 'Setting updated successfully');
        return redirect(route('editSetting',1));
    }

    private function prepare_inputs($inputs)
    {
        $input_file = 'logo_ar';
        if (request()->hasFile($input_file)) {
            $file = request()->file($input_file);
            $filename = rand(0, 20000) . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = base_path(Setting::$uploads_path);
            $upload_success = $file->move($destinationPath, $filename);
            if ($upload_success) {
                $inputs[$input_file] = $filename;
            }
        }else{
        unset($inputs[$input_file]);
        }

        $input_file = 'logo_en';
        if (request()->hasFile($input_file)) {
            $file = request()->file($input_file);
            $filename = rand(0, 20000) . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = base_path(Setting::$uploads_path);
            $upload_success = $file->move($destinationPath, $filename);
            if ($upload_success) {
                $inputs[$input_file] = $filename;
            }
        }else{
        unset($inputs[$input_file]);
        }
        $input_file = 'logo_white_ar';
        if (request()->hasFile($input_file)) {
            $file = request()->file($input_file);
            $filename = rand(0, 20000) . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = base_path(Setting::$uploads_path);
            $upload_success = $file->move($destinationPath, $filename);
            if ($upload_success) {
                $inputs[$input_file] = $filename;
            }
        }else{
        unset($inputs[$input_file]);
        }
        $input_file = 'logo_white_en';
        if (request()->hasFile($input_file)) {
            $file = request()->file($input_file);
            $filename = rand(0, 20000) . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = base_path(Setting::$uploads_path);
            $upload_success = $file->move($destinationPath, $filename);
            if ($upload_success) {
                $inputs[$input_file] = $filename;
            }
        }else{
        unset($inputs[$input_file]);
        }

        $inputs['meta_keywords_ar'] = implode('&', $inputs['meta_keywords_ar']);
        $inputs['meta_keywords_en'] = implode('&', $inputs['meta_keywords_en']);
        $inputs['about_ar'] = nl2br($inputs['about_ar'], false);
        $inputs['about_en'] = nl2br($inputs['about_en'], false);
        $inputs['terms_ar'] = nl2br($inputs['terms_ar'], false);
        $inputs['terms_en'] = nl2br($inputs['terms_en'], false);

        return $inputs;
    }

}
