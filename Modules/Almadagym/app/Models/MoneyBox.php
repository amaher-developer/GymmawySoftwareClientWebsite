<?php

namespace App\Modules\Almadagym\app\Models;


class MoneyBox extends GenericModel
{

    protected $dates = [];

    protected $table = 'sw_gym_money_boxes';
    protected $guarded = ['id'];
    protected $appends  = [];
    public static $uploads_path='uploads/gymorders/';
    public static $thumbnails_uploads_path='uploads/gymorders/thumbnails/';


    public function user()
    {
        return $this->belongsTo(GymUser::class, 'user_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
//    public function member_subscription(){
//        return $this->belongsTo(MemberSubscription::class, 'member_subscription_id');
//    }




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

