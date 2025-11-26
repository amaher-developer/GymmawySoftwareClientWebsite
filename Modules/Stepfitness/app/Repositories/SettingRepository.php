<?php

namespace Modules\Stepfitness\app\Repositories;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Criteria\RequestCriteria;
use Modules\Stepfitness\app\Models\Setting;


class SettingRepository extends StepfitnessRepository
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
