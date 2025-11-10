<?php

namespace Modules\Zonegym\Models;


use Modules\Zonegym\Events\SettingUpdated;
use Illuminate\Support\Facades\Cache;

class Banner extends GenericModel
{
    protected $table = 'sw_gym_banners';
    protected $guarded = ['id'];
    protected $appends = [ 'image_name'];
    public static $uploads_path='uploads/banners/';
    public static $thumbnails_uploads_path= 'uploads/banners/thumbnails/';


    public function getImageNameAttribute()
    {
        return $this->getRawOriginal('image');
    }

    public function getImageAttribute()
    {
        $image = $this->getRawOriginal('image');
        if($image)
            return @env('APP_URL_MASTER').self::$uploads_path.$image;

        return asset('resources/assets/front/img/preview_icon.png');
    }

    public function getContentAttribute()
    {
        $lang = 'content_'. $this->lang;
        return $this->$lang;
    }

}
