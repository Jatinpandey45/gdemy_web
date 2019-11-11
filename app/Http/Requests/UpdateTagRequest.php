<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
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
            'tag_name' => ['required',Rule::unique('gk_tags')->ignore($this->route('tag'))],
            'tag_slug' =>  ['required',Rule::unique('gk_tags')->ignore($this->route('tag'))],
        ];
    }
}
