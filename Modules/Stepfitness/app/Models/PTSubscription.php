<?php

namespace Modules\Stepfitness\app\Models;


use Modules\Stepfitness\app\Events\SettingUpdated;
use Illuminate\Support\Facades\Cache;

class PTSubscription extends GenericModel
{
    protected $table = 'sw_gym_pt_subscriptions';
    protected $guarded = ['id'];
    protected $appends = ['name', 'image_name'];
    public static $uploads_path='uploads/subscriptions/';
    public static $thumbnails_uploads_path='uploads/subscriptions/thumbnails/';

    public function getNameAttribute()
    {
        $lang = 'name_'. $this->lang;
        return $this->$lang;
    }
    public function getImageNameAttribute()
    {
        return $this->getRawOriginal('image');
    }
    public function getImageAttribute()
    {
        $image = $this->getRawOriginal('image');
        if($image)
            return asset(self::$uploads_path.$image);

        return asset('resources/assets/front/img/preview_icon.png');
    }



}
