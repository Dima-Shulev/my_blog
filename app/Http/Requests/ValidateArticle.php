<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateArticle extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','min:3','max:100'],
            'content' => ['nullable','string','min:100'],
            'metaKey' => ['nullable','string','min:5'],
            'metaDescription' => ['nullable','string','min:10','max:120'],
            'created_at' => ['required','date'],
            'module' => ['required','string'],
            'selectCategory' => ['required','int','min:1','max:10'],
        ];
    }
}
