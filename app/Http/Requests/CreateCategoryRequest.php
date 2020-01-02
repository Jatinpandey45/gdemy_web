<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'category_name' => 'required|unique:gk_category',
            'category_slug' => 'required|unique:gk_category',
            'category_icon' => 'required' // max 10000kb
           // 'category_icon' => 'mimes:gif,jpeg,jpg,png,tiff,wbmp,ico,jng,bmp,svg,svgz,webp,tif|required|max:1200' // max 10000kb
        ];
    }
}
