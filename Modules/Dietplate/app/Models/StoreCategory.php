<?php

namespace Modules\Dietplate\Models;

class StoreCategory extends GenericModel
{
    protected $table = 'sw_gym_store_categories';
    protected $guarded = ['id'];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        $lang = 'name_' . $this->lang;
        return $this->$lang;
    }

    public function products()
    {
        return $this->hasMany(StoreProduct::class, 'category_id');
    }
}
