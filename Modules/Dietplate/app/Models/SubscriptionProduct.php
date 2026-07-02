<?php

namespace Modules\Dietplate\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionProduct extends Model
{
    protected $table = 'sw_gym_subscription_products';
    protected $guarded = ['id'];
    protected $connection = 'mysql';

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function product()
    {
        return $this->belongsTo(StoreProduct::class, 'product_id');
    }
}
