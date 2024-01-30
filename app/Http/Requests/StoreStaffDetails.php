<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffDetails extends FormRequest
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
        'cid'=>'required|numeric|unique:staffdetails,id,{$this->staffdetails->id}',
        'eid'=>'required|numeric|unique:staffdetails,id,{$this->staffdetails->id}',
        'Name'=>'required',
        'dob'=>'required|date',
        'gender'=>'required',
        'Nationality'=>'required',
        'grade'=>'nullable',
        'position_level'=>'nullable',
        'position_title'=>'nullable',
        'contact_number'=>'required',
        'Qualification'=>'nullable',
        'subject_specilization'=>'nullable',
        'date_of_appointment'=>'required|date',
        'village'=>'required',
        'gewog'=>'required',
        'dzongkhag'=>'required',
        'email'=>'email|nullable|unique:staffdetails,id,{$this->staffdetails->id}',
        'previous_schools_served'=>'nullable',
        [ 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000']
      ];
      if ($this->getMethod() == 'POST') {
    $rules+=[ 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'] ;
  }
  return $rules;
    }
}
