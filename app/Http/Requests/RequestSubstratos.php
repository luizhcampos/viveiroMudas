<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSubstratos extends FormRequest
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
            'nome' => "required|min:3|max:255",
            'quant' => 'nullable|min:0',
            'composto' => "nullable|min:3|max:1000",
            'observacao' => 'nullable|min:1|max:10000',
            'inicioMaturacao' => 'nullable', //regex de data
        ];
    }

    public function messages()
    {
        return[
            'nome.required' => 'Nome Obrigatório!',
            'nome.min' => 'Ops! Nome deve ser maior que 3 caracteres!',
        ];
    }
}
