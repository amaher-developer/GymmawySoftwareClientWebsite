<?php

namespace Modules\Cakorinas\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = @request()->session()->get('user');

        $data = [
            'subscription_id' => 'required',
//            'payment_method' => 'required',
        ];
        if(!$user){
            $data['name'] = 'required';
            $data['phone'] = 'required';
//            $data['gender'] = 'required';
//            $data['address'] = 'required';
        }
        return $data;
    }
}



