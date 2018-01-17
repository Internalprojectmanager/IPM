<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectValidator extends FormRequest
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
            'project_name' => 'required',
            'deadline' => 'date_format:Y/m/d',
        ];
    }

    public function messages()
    {
        return [
            'project_name.required' => 'A project name is required',
            'deadline.date_format' => 'The date is not well formatted',
        ];
    }
}
