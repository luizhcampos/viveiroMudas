<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestMudas extends FormRequest
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
            'nomePopular' => "required|min:3|max:1000",
            'nomeCientifico' => 'nullable|min:3|max:1000',
            'dataColeta' => 'nullable',
            'quant' => 'required',
            'custoProducao'=>'required',//'|regex:/^\d+(\.\d{1,2})?$/'
            'blocoPlantio'=> 'required',
            'canteiroPlantio' => 'required',
            'estagioMuda' => 'required',
            'idRecipientes' => 'nullable',
            'idSementes' => 'nullable',
            'idSubstratos' => 'nullable',
            'volume_Subs_Recip' => 'nullable',
            'observacao' => 'nullable|min:1|max:10000',
        ];
    }

    public function messages()
    {
        return[

            'nomePopular.required' => 'Nome Obrigatório!',
            'nomePopular.min' => 'Ops! Nome deve ser maior que 3 caracteres!',
            'quant.required' => 'Quantidade Obrigatória!',
            'custoProducao.required' => 'Custo de produção é obrigatório!',
            'blocoPlantio'=> 'Preencha o valor de Bloco de Plantio!',
            'canteiroPlantio' => 'Preencha o valor do Canteiro de Plantio!',
            'estagioMuda' => 'Preencha o valor do estágio    de Plantio!',
        ];
    }
}
