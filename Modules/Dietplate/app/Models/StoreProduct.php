<?php

namespace Modules\Dietplate\Models;

class StoreProduct extends GenericModel
{
    protected $table = 'sw_gym_store_products';
    protected $guarded = ['id'];
    protected $appends = ['name', 'image_url'];

    public static $uploads_path = 'uploads/products/';

    public function getNameAttribute()
    {
        $lang = 'name_' . $this->lang;
        return $this->$lang;
    }

    public function getImageUrlAttribute()
    {
        $image = $this->getRawOriginal('image');
        if ($image) {
            return env('APP_URL_MASTER') . self::$uploads_path . $image;
        }
        return asset('Modules/Dietplate/resources/assets/img/meal-placeholder.png');
    }

    public function category()
    {
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }
}
