<?php

namespace Modules\Dietplate\Models;


class SubscriptionCategory extends GenericModel
{
    protected $table = 'sw_gym_subscription_categories';
    protected $guarded = ['id'];

    protected $appends = ['name', 'image_name'];
    public static $uploads_path='uploads/subscription_categories/';
    public static $thumbnails_uploads_path='uploads/subscription_categories/thumbnails/';

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
            return @env('APP_URL_MASTER').self::$uploads_path.$image;

        return asset('Modules/Dietplate/resources/assets/img/logo.png');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscription_category_id');
    }
}
