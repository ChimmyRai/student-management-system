<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
          'student_code'=>'required|unique:studentbios,id,{$this->studentbio->id}',
          'index_number'=>'required|unique:studentbios,id,{$this->studentbio->id}',
          'adm_no'=>'required',
          'Name'=>'required',
          'gender'=>'required',
          'dob'=>'required|date',
          'village'=>'required',
          'gewog'=>'required',
          'dzongkhag'=>'required',
          'guardian_contact'=>'required|regex:^\d+(,\d+)*$^',
          'email'=>'email|unique:users',
          'date_of_joining_school'=>'required|date',
          'class_when_joining_school'=>'required',
          'current_class'=>'required',
          'current_section'=>'required',
          'previous_schools'=>'required|nullable',
          'hostel_status'=>'required',
          'house'=>'required',
          [ 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000']

        ];
        if ($this->getMethod() == 'POST') {
      $rules+=[ 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'] ;
    }
    return $rules;
    }
}
