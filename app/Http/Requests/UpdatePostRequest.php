<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug,' . $this->route('post.id')],
            'preview' => ['required', 'string', 'max:255'],
            'body' => ['string', 'max:255'],
            'is_published' => ['boolean'],
            'user_id' => ['integer', 'exists:users,id']
        ];
    }
}
