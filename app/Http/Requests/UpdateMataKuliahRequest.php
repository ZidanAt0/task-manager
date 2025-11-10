<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMataKuliahRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $courseId = $this->route('course'); // dari resource route

        return [
            'name' => [
                'required','string','max:100',
                Rule::unique('courses','name')
                    ->where(fn($q) => $q->where('user_id', auth()->id()))
                    ->ignore($courseId),
            ],
            'code'            => ['nullable','string','max:20'],
            'dosen_pengampu'  => ['required','string','max:100'],
            'semester'        => ['required','integer','between:1,8'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'           => 'nama mata kuliah',
            'code'           => 'kode',
            'dosen_pengampu' => 'dosen pengampu',
            'semester'       => 'semester',
        ];
    }
}