<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Enter Your :attribute First',
            'password.required' => 'Enter Your :attribute First',
        ];
    }

    public function attributes()
    {
        return[
            'email' => 'User Email',
            'password' => 'User pPassword',
        ];
    }



}
