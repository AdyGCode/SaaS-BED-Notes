<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('course');
        return [
            'code'  => ['sometimes','min:3', Rule::unique('courses','code')->ignore($id)],
            'title' => ['sometimes','min:3'],
        ];
    }
}
