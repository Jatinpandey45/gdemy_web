<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class UpdateCategoryRequest extends FormRequest
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
            'category_name' => ['required',Rule::unique('gk_category')->ignore($this->route('category'))],
            'category_slug' =>  ['required',Rule::unique('gk_category')->ignore($this->route('category'))],
            'category_icon' => 'mimes:gif,jpeg,jpg,png,tiff,wbmp,ico,jng,bmp,svg,svgz,webp,tif|max:1200' // max 10000kb
        ];
    }
}