<?php

namespace Modules\Fitdose\app\Repositories;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Fitdose\Models\Setting;


class SettingRepository extends FitdoseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }

    public function first($columns = [])
    {
        return Cache::remember('settings',60 * 24 * 30, function () {
            return Cache::get('settings') ? null : Setting::first();
        });
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }



}
