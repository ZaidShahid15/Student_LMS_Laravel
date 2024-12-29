<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserREquest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password'=> 'required',
            'confirm_password'=> 'required|same:password',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Enter Your :attribute First',
            'email.required' => 'Enter Your :attribute First',
            'password.required' => 'Enter Your :attribute First',
            'confirm_password.required' => 'Enter Your :attribute First',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'User Name',
            'email' => 'User Email',
            'password' => 'User pPassword',
            'confirm_password' => 'User Confirm_Password',
        ];
    }


}
