<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminQuizRequest extends FormRequest
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
            'question_text' => 'required',
            'slug' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'correct' => 'required',
            'answer_explanation' => 'required',
            'category' => 'required|array',
               
        ];
    }
}
