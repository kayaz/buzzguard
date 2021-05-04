<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectFormRequest extends FormRequest
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
            'name' => 'required',
            'client_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'keywords' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'To pole jest wymagane',
            'year.required' => 'To pole jest wymagane',
            'name.required' => 'To pole jest wymagane',
            'client_id.required' => 'To pole jest wymagane',
            'date_start.required' => 'To pole jest wymagane',
            'date_end.required' => 'To pole jest wymagane',
            'keywords.required' => 'To pole jest wymagane',
        ];
    }
}
