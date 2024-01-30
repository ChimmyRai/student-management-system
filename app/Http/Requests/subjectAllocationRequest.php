<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subjectAllocationRequest extends FormRequest
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
      $rules= [

      //  'User_ID'=>'required|numeric',
        'Teacher_Name'=>'required',
        'Section'=>'required',
        'Subject'=>'required',
        'Class'=>'required',


      ];
      return $rules;
    }
}
