<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Book_Issued_Request extends FormRequest
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
            'user_id' => 'required',
            'book_id' => 'required',
            'issued_at' => 'required',
            'due_date' => 'required',
        ];
    }
}
