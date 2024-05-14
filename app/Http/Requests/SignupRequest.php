<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
        return
            [
                "firstname" => "required|regex:/^[a-zA-Z\s]+$/",
                "lastname" => "required|alpha",
                "email" => "required|email|unique:users",
                "password" => "required|min:8|max:12",
                "country" => "required",
                "gender" => "required",
                "hobbies" => "required",
            ];
    }
    public function withValidator($validator)
    {
        $validator->stopOnFirstFailure();
    }
}
