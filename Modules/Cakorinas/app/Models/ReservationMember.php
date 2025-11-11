<?php

namespace App\Modules\Cakorinas\app\Models;


use App\Modules\Cakorinas\app\Events\SettingUpdated;
use Illuminate\Support\Facades\Cache;

class ReservationMember extends GenericModel
{
    protected $table = 'sw_gym_potential_members';
    protected $guarded = ['id'];
    protected $appends = [ 'image_name'];
    public static $uploads_path='uploads/members/';
    public static $thumbnails_uploads_path='uploads/members/thumbnails/';





}
