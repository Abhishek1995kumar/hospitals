<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SendNotificationRequest extends FormRequest {
    public function authorize(): bool {
        return false;
    }


    public function rules(): array {
        return [
            'type'=> [
                'required',
                // 'in:onboarding,birthday,holiday,event'
            ],

            'title'=> [
                'required',
                'string',
                'max:100'
            ],

            'message'=> [
                'required',
                'string',
                'max:500'
            ],

            'users'=> [
                'required',
                'array'
            ],

            'users.*'=> [
                'exists:users,id'
            ]
        ];
    }
}
