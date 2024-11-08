<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
        $emailRule = request()->isMethod('POST') ? Rule::unique('users', 'email') : Rule::unique('users', 'email')->ignore($this->user->id);
        $passwordRule = request()->isMethod('POST') ? 'required' : 'sometimes';

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $emailRule],
            'password' => [$passwordRule, 'string', 'max:255', 'confirmed'],
        ];
    }
}
