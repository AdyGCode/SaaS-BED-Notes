<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('student');
        return [
            'student_number' => ['sometimes', Rule::unique('students','student_number')->ignore($id)],
            'given_name'     => ['sometimes','min:2'],
            'family_name'    => ['sometimes','min:2'],
            'email'          => ['sometimes','email', Rule::unique('students','email')->ignore($id)],
        ];
    }
}
