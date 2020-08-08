<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // all users are authorized to make this request
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        //define validation rules and return array
        // validation rules in AskQuestionRequest 
        // and to actually validate the request we must type hint di 
        // method kita di form

        return [
            'title' => 'required|max:255',
            'body' => 'required'
        ];
    }
}
