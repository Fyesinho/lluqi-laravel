<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class LoginAPIRequest extends FormRequest
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
    public function rules(){
        return [
            'email'     => 'required|email',
            'password'  => 'required',
        ];
    }

    public function messages(){
        return [
            'email.required'    => 'Campo email es requerido',
            'email.email'       => 'El campo email no corresponde a un email valido',

            'password.required' => 'Campo password es requerido'
        ];
    }

    public function response(array $errors){
        return new JsonResponse($errors, 422);
    }
}
