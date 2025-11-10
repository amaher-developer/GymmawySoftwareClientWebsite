<?php

namespace Modules\Zonegym\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class ContactRequest extends FormRequest
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
        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
//            'message' => 'required',
//            'g-recaptcha-response' => 'required',
        ];
    }


    public function messages()
    {
        return [

            'name.required' => trans('global.error_name'),
//            'phone.required' => trans('global.error_phone'),
            'email.required' => trans('global.error_email'),
            'message.required' => trans('global.error_message'),
//            'g-recaptcha-response.required'  => trans('global.error_captcha'),
        ];

//        if (Request::segment(1) == 'en'){
//            return [
//
//                'name.required' => 'A name is required',
//                'phone.required' => 'A phone is required',
//                'email.required' => 'A email is required',
//                'message.required' => 'A message is required',
//            ];
//    }else {
//
//            return [
//
//                'name.required' => 'Ø§Ø¯Ø®Ù„ Ø§Ù„Ø§Ø³Ù… Ø¨Ø´ÙƒÙ„ ØµØ­ÙŠØ­',
//                'phone.required' => 'Ø§Ø¯Ø®Ù„ Ø§Ù„ØªÙ„ÙŠÙÙˆÙ† Ø¨Ø´ÙƒÙ„ ØµØ­ÙŠØ­',
//                'email.required' => 'Ø§Ø¯Ø®Ù„ Ø§Ù„Ø¨Ø±ÙŠØ¯ Ø§Ù„Ø§Ù„ÙŠÙƒØªØ±ÙˆÙ†ÙŠ Ø¨Ø´ÙƒÙ„ ØµØ­ÙŠØ­',
//                'message.required' => 'Ø§Ø¯Ø®Ù„ Ø§Ù„Ø±Ø³Ø§Ù„Ø© Ø¨Ø´ÙƒÙ„ ØµØ­ÙŠØ­',
//            ];
//        }


    }
}
