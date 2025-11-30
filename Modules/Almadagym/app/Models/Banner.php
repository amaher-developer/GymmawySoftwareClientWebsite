<?php

namespace App\Modules\Almadagym\app\Models;


use App\Modules\Almadagym\app\Events\SettingUpdated;
use Illuminate\Support\Facades\Cache;

class Banner extends GenericModel
{
    protected $table = 'sw_gym_banners';
    protected $guarded = ['id'];
    protected $appends = ['name', 'content', 'image_name'];
    public static $uploads_path='uploads/banners/';
    public static $thumbnails_uploads_path='uploads/banners/thumbnails/';


    public function getNameAttribute()
    {
        return $this->getRawOriginal('name');
    }
    public function getContentAttribute()
    {
        return $this->getRawOriginal('content');
    }

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


}

