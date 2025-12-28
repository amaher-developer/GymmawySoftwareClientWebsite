<?php

namespace Modules\Stepfitness\app\Http\Requests;

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

        $today = \Carbon\Carbon::now()->format('Y-m-d');
        $maxDate = \Carbon\Carbon::now()->addMonth()->format('Y-m-d');

        $data = [
            'subscription_id' => 'required',
            'payment_method' => 'required',
            'joining_date' => "required|date|after_or_equal:{$today}|before_or_equal:{$maxDate}",
        ];
        if(!$user){
            $data['name'] = 'required';
            $data['phone'] = 'required';
            $data['gender'] = 'required';
            $data['address'] = 'required';
        }
        return $data;
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'joining_date.required' => trans('front.joining_date_required'),
            'joining_date.date' => trans('front.joining_date_must_be_valid_date'),
            'joining_date.after_or_equal' => trans('front.joining_date_cannot_be_in_past'),
            'joining_date.before_or_equal' => trans('front.joining_date_cannot_exceed_one_month'),
        ];
    }
}
