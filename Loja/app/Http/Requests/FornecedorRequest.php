<?php

namespace londev\Http\Requests;

use londev\Http\Requests\Request;

class FornecedorRequest extends Request
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
        return ['telefone_1'=>'required','nome'=>'required'];
    }
}
