<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          => 'required',
            'resume'        => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'height'        => 'required',
            'width'         => 'required',
            'depth'         => 'required',
            'weight'        => 'required',
            'amount'        => 'required | integer',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório.',
            'integer'   => 'A :attribute deve ter um numero inteiro'
        ];
    }
}
