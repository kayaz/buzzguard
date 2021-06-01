<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrivateFormRequest extends FormRequest
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
            'status' => 'required',
            'year' => 'required',
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'To pole jest wymagane',
            'year.required' => 'To pole jest wymagane',
            'name.required' => 'To pole jest wymagane'
        ];
    }
}
