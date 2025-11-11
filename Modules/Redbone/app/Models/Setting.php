<?php

namespace App\Modules\Redbone\app\Models;


use Illuminate\Support\Facades\Cache;

class Setting extends GenericModel
{
//    protected $table = '';
    protected $guarded = ['id'];
    protected $appends = ['name','address', 'logo', 'logo_white', 'logo_thumb', 'about', 'terms', 'meta_description', 'meta_keywords'];
    public static $uploads_path = 'uploads/settings/';
    protected $casts = ['images' => 'json', 'cover_images' => 'json', 'vat_details' => 'json', 'reservation_details' => 'json', 'wa_details' => 'json'];

    protected $dispatchesEvents = ['updated' => SettingUpdated::class];


    public function getAddressAttribute()
    {
        $lang = 'address_' . $this->lang;
        return (string)$this->$lang;
    }
    public function getNameAttribute()
    {
        $lang = 'name_' . $this->lang;
        return (string)$this->$lang;
    }

    public function getMetaDescriptionAttribute()
    {
        $meta_description = 'meta_description_' . $this->lang;
        return (string)$this->$meta_description;
    }

    public function getMetaKeywordsAttribute()
    {
        $meta_keywords = 'meta_keywords_' . $this->lang;
        $meta_keywords = $this->getRawOriginal($meta_keywords);
//        $meta_keywords = explode('&', $meta_keywords);
        $meta_keywords = str_replace('&', ', ', $meta_keywords);
        return (string)$meta_keywords;
    }

    public function getLogoArAttribute($logo)
    {
        if ($logo) {
            return Asset(self::$uploads_path . $logo);
        } else
            return $logo;
    }

    public function getLogoEnAttribute($logo)
    {

        if ($logo) {
            return Asset(self::$uploads_path . $logo);
        } else
            return $logo;
    }

    public function getLogoWhiteArAttribute($logo)
    {
        if ($logo) {
            return Asset(self::$uploads_path . $logo);
        } else
            return $logo;
    }

    public function getLogoWhiteEnAttribute($logo)
    {

        if ($logo) {
            return Asset(self::$uploads_path . $logo);
        } else
            return $logo;
    }

    public function getLogoAttribute()
    {
        $lang = 'logo_' . $this->lang;
        return $this->$lang;
    }
    public function getLogoThumbAttribute()
    {
        $logo = 'logo_' . $this->lang;
        return self::$uploads_path.'thumb_'.$this->getRawOriginal($logo);
    }

    public function getLogoWhiteAttribute()
    {
        $lang = 'logo_white_' . $this->lang;
        return $this->$lang;
    }


    public function getAboutAttribute()
    {
        $lang = 'about_' . $this->lang;
        return (string)$this->$lang;
    }

    public function getTermsAttribute()
    {
        $lang = 'terms_' . $this->lang;
        return (string)$this->$lang;
    }

    public function getMetaKeywordsArAttribute($meta_keywords_ar)
    {

        if ($meta_keywords_ar) {
            return explode('&', $meta_keywords_ar);
        } else
            return $meta_keywords_ar;
    }

    public function getMetaKeywordsEnAttribute($meta_keywords_en)
    {

        if ($meta_keywords_en) {
            return explode('&', $meta_keywords_en);
        } else
            return $meta_keywords_en;
    }

    public function updateSettingWithCache()
    {
        return Cache::put('settings', $this, 60 * 24 * 30);
    }

}

