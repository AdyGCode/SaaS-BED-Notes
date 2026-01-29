<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'code'  => ['required','min:3','unique:courses,code'],
            'title' => ['required','min:3'],
        ];
    }
}
