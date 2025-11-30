<?php

namespace App\Modules\Cakorinas\app\Models;

class PaymentOnlineInvoice extends GenericModel
{
    protected $table = 'sw_gym_online_payment_invoices';
    protected $guarded = ['id'];
    protected $appends = [];
    public static $uploads_path='uploads/payments/';
    public static $thumbnails_uploads_path='uploads/payments/thumbnails/';

    protected $casts = ['response_code' => 'json'];

    public function subscription(){
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
}

