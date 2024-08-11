<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => [$this->requiredOrNot(), "string", "min:3", "max:50" ],
            // 'image'=> ['required','image','mimes:png,jpg,jpeg'],
            'image'=> ['required'],
            'content' => [$this->requiredOrNot(),'string'],
            'status' => ['in:active,disable'],
            'blogs' => 'required|array',
            'blogs.*' => 'exists:blogs,id',
            // 'blogs'=> ['exists:blogs,id'],
        ];
    }

    public function requiredOrNot()
    {
        return $this->isMethod('post')?'required':'sometimes';
    }
}
