<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        // dd(request());
        return [
            // 'post_id' => 'required|exists:posts,id',
            // 'author_name' => 'required|string|max:255',
            'content' => 'required|string|min:2|max:5000',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            // 'author_name.required' => 'Author name is required.',
            // 'author_name.string' => 'Author name must be a valid string.',
            // 'author_name.max' => 'Author name may not be greater than 255 characters.',
            'content.required' => 'Content is required.',
            'content.string' => 'Content must be a valid string.',
            'content.min' => 'Content must be at least 2 characters long.',
            'content.max' => 'Content may not be greater than 5000 characters.',

        ];
    }
}
