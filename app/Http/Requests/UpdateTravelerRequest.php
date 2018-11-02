<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Traveler;

class UpdateTravelerRequest extends FormRequest
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
        $user = User::whereEmail($this['email'])->first();
        return [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'gender_id' => 'required',
            'birthday'  => 'required',
            'phone'     => 'required',
            'password'  => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required'     => 'Campo nombre es requerido',

            'email.required'    => 'Campo email es requerido',
            'email.email'       => 'El campo email no corresponde a un email valido',
            'email.unique'      => 'Email ya existente',

            'gender_id.required'=> 'Campo genero es requerido',
            'birthday.required' => 'Campo fecha de nacimiento es requerido',
            'phone.required'    => 'Campo telefono es requerido',
            'password.required' => 'Campo password es requerido'
        ];
    }
}
