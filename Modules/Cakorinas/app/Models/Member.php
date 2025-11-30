<?php

namespace Modules\Cakorinas\app\Models;


use Modules\Cakorinas\app\Events\SettingUpdated;
use Illuminate\Support\Facades\Cache;

class Member extends GenericModel
{
    protected $table = 'sw_gym_members';
    protected $guarded = ['id'];
    protected $appends = [ 'image_name'];
    public static $uploads_path='uploads/members/';
    public static $thumbnails_uploads_path='uploads/members/thumbnails/';


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



