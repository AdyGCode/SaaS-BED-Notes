<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'student_number' => ['required','unique:students,student_number'],
            'given_name'     => ['required','min:2'],
            'family_name'    => ['required','min:2'],
            'email'          => ['required','email','unique:students,email'],
        ];
    }
}
