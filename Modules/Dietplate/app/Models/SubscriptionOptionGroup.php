<?php

namespace Modules\Dietplate\Models;

class SubscriptionOptionGroup extends GenericModel
{
    protected $table = 'sw_gym_subscription_option_groups';
    protected $guarded = ['id'];
    protected $appends = ['name'];

    const SELECTION_SINGLE   = 'single';
    const SELECTION_MULTIPLE = 'multiple';

    public function getNameAttribute()
    {
        $lang = 'name_' . $this->lang;
        return $this->$lang ?? $this->name_ar;
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function options()
    {
        return $this->hasMany(SubscriptionOption::class, 'option_group_id')->orderBy('list_order');
    }

    public function storeCategory()
    {
        return $this->belongsTo(StoreCategory::class, 'category_id');
    }
}
