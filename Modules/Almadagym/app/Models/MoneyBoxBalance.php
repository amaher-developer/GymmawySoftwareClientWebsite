<?php

namespace App\Modules\Almadagym\app\Models;

use Illuminate\Database\Eloquent\Model;

class MoneyBoxBalance extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sw_gym_money_box_balances';
    protected $guarded = ['id'];
    public $timestamps = true;
}
