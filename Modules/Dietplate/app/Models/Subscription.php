<?php

namespace Modules\Dietplate\Models;


use Modules\Dietplate\app\Events\SettingUpdated;
use Illuminate\Support\Facades\Cache;

class Subscription extends GenericModel
{
    protected $table = 'sw_gym_subscriptions';
    protected $guarded = ['id'];

    protected $appends = ['name', 'content', 'image_name'];
    public static $uploads_path='uploads/subscriptions/';
    public static $thumbnails_uploads_path='uploads/subscriptions/thumbnails/';

    public function getNameAttribute()
    {
        $lang = 'name_'. $this->lang;
        return $this->$lang;
    }
    public function getContentAttribute()
    {
        $lang = 'content_'. $this->lang;
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
            return @env('APP_URL_MASTER').self::$uploads_path.$image;

        return asset('Modules/Dietplate/resources/assets/img/logo.png');
    }

    public function category()
    {
        return $this->belongsTo(SubscriptionCategory::class, 'category_id');
    }

}
