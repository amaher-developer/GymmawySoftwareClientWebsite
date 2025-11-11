<?php

namespace App\Modules\Stepfitness\app\Models;


use Carbon\Carbon;

class MemberSubscription extends GenericModel
{

    protected $dates = ['deleted_at'];

    protected $table = 'sw_gym_member_subscription';
    protected $guarded = ['id'];
    protected $appends = [];
    public static $uploads_path='uploads/members/';
    protected $casts = ['activities' => 'json'];
    public static $thumbnails_uploads_path='uploads/members/thumbnails/';



    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function subscription(){
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function toArray()
    {
        return parent::toArray();
        $to_array_attributes = [];
        foreach ($this->relations as $key => $relation) {
            $to_array_attributes[$key] = $relation;
        }
        foreach ($this->appends as $key => $append) {
            $to_array_attributes[$key] = $append;
        }
        return $to_array_attributes;
    }

}
