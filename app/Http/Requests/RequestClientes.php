<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestClientes extends FormRequest
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
            'nome' => "required|unique:clientes,nome|min:3|max:255",
            'cidade' => 'required|min:3|max:255'
            
        ];
    }

    public function messages()
    {
        return[
            'nome.required' => 'Nome Obrigatório!',
            'nome.min' => 'Ops! Nome deve ser maior que 3 caracteres!',
            'nome.unique' => 'Já existe um Cliente com esse nome Salvo. Mude o nome do cliente.',
            'cidade.required' => 'Cidade Obrigatório!',
            'cidade.min' => 'Ops! Cidade deve ter mais de 3 caracteres!',
        ];
    }
}
