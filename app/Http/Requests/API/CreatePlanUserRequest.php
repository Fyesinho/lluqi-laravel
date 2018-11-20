<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CreatePlanUserRequest extends FormRequest
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
            'plan_id'   => 'required|exists:plans,id',
        ];
    }

    public function messages(){
        return [
            'plan_id.required'  => 'Campo plan_id es requerido',
            'plan_id.exists'    => 'El Plan no existe !',
        ];
    }

    public function response(array $errors){
        return new JsonResponse($errors, 422);
    }
}
