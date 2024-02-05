<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckReviewsRequest extends FormRequest
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
        return[
            'title' => ['required','string','min:4','max:100'],
            'content' => ['required','string','min:50'],
            'subscription' => ['nullable'],
        ];
    }
}
