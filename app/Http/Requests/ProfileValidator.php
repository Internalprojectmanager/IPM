<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required|email|max:100|unique:users,email,'. Auth::id(),
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
            'first_name' => 'required| min:3',
            'last_name' => 'required| min:3',
        ];
    }
}
