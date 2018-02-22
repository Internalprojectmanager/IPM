<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
            'feature_name' => 'required',
            'feature_status' => 'required|exists:status,id|between:1,6'
        ];
    }

    public function messages()
    {
        return [
            'feature_name.required' => 'A Feature name is required',
            'feature_status.exists' => 'Feature status is not valid'
        ];
    }
}
