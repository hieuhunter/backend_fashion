<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required',
            'slug' => 'unique:comment',
            'product_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Content is required',
            'slug.unique' => 'Slug already exists',
            'product_id.required' => 'post_slug is required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::lower(Str::random(5))
        ]);
    }
}
