<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTweetRequest extends FormRequest
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
        return [
            "content" =>"required|max:140",
            "content_ar" =>"required|max:140",
            "content_en" =>"required|max:140",
            "user_id" =>"nullable|exists:users,id"
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([

            'content' => [
                'ar' => $this->content_ar,
                'en' => $this->content_en ,
            ],
            'user_id' => auth()->user()->id,
        ]);
    }
}
