<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSementes extends FormRequest
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
        $id = $this->segment(2);

        return [
            'nomePopular' => "required|min:3|max:255",
            'nomeCientifico' => 'nullable|min:3|max:10000',
            'quant' => 'required',
            'observacao' => 'nullable|min:1|max:10000',
            'localColeta' => 'nullable|min:1|max:500',
            'dataColeta' => 'nullable', //regex de data
        ];
    }

    public function messages()
    {
        return[
            'nomePopular.required' => 'Nome Obrigatório!',
            'nomePopular.min' => 'Ops! Nome deve ser maior que 3 caracteres!',
            'quant' => 'Quantidade Obrigatória!',
        ];
    }
}
