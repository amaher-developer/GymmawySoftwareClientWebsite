<?php

namespace Modules\Zonegym\Models;

use Modules\Zonegym\Models\GenericModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends GenericModel
{

    protected $dates = ['deleted_at'];

//    protected $table = '';

    protected $connection = 'gymmawy_connection';
    protected $guarded = ['id'];
    protected $appends = [];
    public static $uploads_path='uploads/contacts/';
    public static $thumbnails_uploads_path='uploads/contacts/thumbnails/';



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
