<?php

namespace Modules\Dietplate\Models;

class MemberSubscriptionOption extends GenericModel
{
    protected $table = 'sw_gym_member_subscription_options';
    protected $guarded = ['id'];

    public function memberSubscription()
    {
        return $this->belongsTo(MemberSubscription::class, 'member_subscription_id');
    }

    public function option()
    {
        return $this->belongsTo(SubscriptionOption::class, 'option_id');
    }
}
