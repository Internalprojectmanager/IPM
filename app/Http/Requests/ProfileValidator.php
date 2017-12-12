<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileValidator extends FormRequest
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
            'email' => 'required|email|unique:users|max:100',
            'password' => 'present|max:50',
            'password_confirm' => 'present|confirmed:password',
            'first_name' => 'required| min:2',
            'last_name' => 'required| min:2',
        ];
    }
}
