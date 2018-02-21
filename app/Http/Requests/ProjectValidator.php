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
            'project_name' => 'required|min:3|max:200',
            'deadline' => 'nullable|date_format:Y/m/d',
            'description' => 'present|nullable',
            'status' => 'required',
            'project_code' => 'present|nullable|min:3|max:15',
            'new_client' => 'present|nullable|min:3|max:100',

        ];
    }

    public function messages()
    {
        return [
            'project_name.required' => 'A project name is required',
            'project_code.required' => 'A project code is required',
            'deadline.date_format' => 'Deadline is not a valid date',
            'status.required' => 'Project Status is required',
        ];
    }
}
