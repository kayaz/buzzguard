<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PageFormRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title, '-')
        ]);
    }

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
            'title' => 'required|string|min:2|max:100|unique:pages',
            'content' => 'required|string|min:5',
            'menu' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'To pole jest wymagane',
            'title.unique' => 'Taka strona już istnieje',
            'title.max.string' => 'Maksymalna ilość znaków: 100',
            'title.min.string' => 'Minimalna ilość znaków: 5',
            'content.required' => 'To pole jest wymagane',
        ];
    }
}
