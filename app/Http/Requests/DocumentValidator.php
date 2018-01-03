<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentValidator extends FormRequest
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
            'upload' => 'between:0,10000| mimes:doc,docx,jpeg,jpg,pdf,png,psd,xls,xlsx,ppt,pptx,bmp,txt,rtf',
            'document_title' => 'required',
            'status' => 'required',
            'release_id' => 'required'
        ];
    }
}
