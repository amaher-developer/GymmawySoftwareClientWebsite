<?php

namespace App\Modules\Sixtyminutes\app\Models;


use App\Modules\Sixtyminutes\app\Events\SettingUpdated;
use Illuminate\Support\Facades\Cache;

class PTClass extends GenericModel
{
    protected $table = 'sw_gym_pt_classes';
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

        return asset('placeholder_black.png');
    }



}
