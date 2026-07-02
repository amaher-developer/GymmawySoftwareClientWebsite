<?php

namespace Modules\Dietplate\Models;

class SubscriptionOption extends GenericModel
{
    protected $table = 'sw_gym_subscription_options';
    protected $guarded = ['id'];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        $lang = 'name_' . $this->lang;
        return $this->$lang ?? $this->name_ar;
    }

    public function group()
    {
        return $this->belongsTo(SubscriptionOptionGroup::class, 'option_group_id');
    }

    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'product_id');
    }
}
