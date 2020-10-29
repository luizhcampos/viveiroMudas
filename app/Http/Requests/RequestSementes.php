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
            'peso_100' => 'required|min:1',
            'quant_total' => 'required|min:1',
            'observacao' => 'nullable|min:1|max:10000',
            'localColeta' => 'required|min:1|max:500',
            'dataColeta' => 'required', //regex de data*/
        ];
    }

    public function messages()
    {
        return[
            'nomePopular.required' => 'Nome Popular é Obrigatório!',
            'nomePopular.min' => 'Ops! Nome Popular deve ser maior que 3 caracteres!',
            'localColeta.required' => 'Local da Coleta é Obrigatório!',
            'dataColeta.required' => 'Data da Coleta é Obrigatório!',
            'peso_100.required' => 'Peso de 100g é Obrigatório!',
            'quant_total.required' => 'Peso Total é Obrigatório!',
        ];
    }
}
