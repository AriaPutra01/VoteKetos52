<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NisnVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nisn' => 'required|integer|digits:10',
        ];
    }
}
