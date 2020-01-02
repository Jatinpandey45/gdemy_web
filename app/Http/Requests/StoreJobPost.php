<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobPost extends FormRequest
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

            'post_title' => 'required',
            'post_slug' => 'required',
            'published_at' => 'required',
            'post_title' => 'required',
            'featured_image' => 'required',
            'post_desc' => 'required'
    
        ];
    }
}
