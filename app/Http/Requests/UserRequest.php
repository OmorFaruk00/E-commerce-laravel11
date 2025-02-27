<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        $userId = $this->route('user') ? $this->route('user')->id : null;
        return [
            'name' => 'required',
            'email' => 'required',Rule::unique('users', 'email')->ignore($userId),
            'phone' => 'required',
            'role_id' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'password' =>  ['required', 'string', Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols(),
            // ->uncompromised(), 
            'confirmed'
        ],
        ];
    }
}
