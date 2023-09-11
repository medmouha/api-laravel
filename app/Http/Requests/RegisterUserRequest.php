<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
        {
            return [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required'
            ];           
        }
    
        public function failedValidation(Validator $validator)
        {
            throw new HttpResponseException(response()->json([
                'success'=> false,
                'status_code' => 422,
                'error'=> true,
                'message'=>"erreur de validation",
                'errorsList'=> $validator->errors()
            ]));
        }
    
        public function messages()
        {
            return [
                'name.required' => "Le nom est obligatoire",
                'email.required'=> "L'email est obligatoire",
                'email.unique'=> "cette email existe déjà",
                'password.required' => "Le mot de passe est obligatoire"
            ];
            
        }
}
