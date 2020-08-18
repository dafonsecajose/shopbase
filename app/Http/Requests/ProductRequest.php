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
            'images.*'        => 'image'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo ":attribute" é obrigatório!',
            'integer'   => 'A :attribute deve ter um numero inteiro',
            'images'    => 'Não é uma imagem válida!'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name'          => filter_var($this->name,FILTER_SANITIZE_STRIPPED),
            'resume'        => filter_var($this->resume,FILTER_SANITIZE_STRIPPED),
            'description'   => filter_var($this->description,FILTER_SANITIZE_STRIPPED),
            'price'         => filter_var($this->price, FILTER_VALIDATE_FLOAT),
            'height'        => filter_var($this->height, FILTER_VALIDATE_FLOAT),
            'width'         => filter_var($this->width, FILTER_VALIDATE_FLOAT),
            'depth'         => filter_var($this->depth, FILTER_VALIDATE_FLOAT),
            'weight'        => filter_var($this->weight, FILTER_VALIDATE_FLOAT),
            'amount'        => filter_var($this->amount, FILTER_VALIDATE_FLOAT),
        ]);
    }
}
