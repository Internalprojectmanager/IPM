<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseValidator extends FormRequest
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
            'release_name' => 'required|max:100',
            'author' =>  'required|string|max:100',
            'specification' => 'required|string|max:100'
        ];
    }
    public function messages()
    {
        return [
            'release_name.required' => 'A Name is required',
            'author.required'  => 'A Author is required',
            'specification.required'  => 'A Specificationtype is required',

        ];
    }
}
