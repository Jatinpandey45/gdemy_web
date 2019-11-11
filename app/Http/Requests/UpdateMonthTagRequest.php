<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateMonthTagRequest extends FormRequest
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
            'month_name' => ['required',Rule::unique('gk_month_tags')->ignore($this->route('monthly'))],
            'month_slug' =>  ['required',Rule::unique('gk_month_tags')->ignore($this->route('monthly'))],
        ];
    }
}
