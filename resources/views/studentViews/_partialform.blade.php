
<div class="form-group">
{!!form::label('student code','Student Code:')!!}
{!!form::text('student_code',null,['class'=>'form-control'])!!}
</div>

  <div class="form-group">
  {!!form::label('index number','index number:')!!}
  {!!form::text('index_number',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('admission number','Admission number:')!!}
  {!!form::text('adm_no',null,['class'=>'form-control'])!!}
  </div>



  <div class="form-group">
  {!!form::label('std Name','Name:')!!}
  {!!form::text('Name',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('gender','Sex:')!!}
  {!!form::Select('gender',array('male' => 'male', 'female' => 'female'),'',['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('Date of birth','DOB:')!!}
  {!!form::date('dob',\Carbon\Carbon::now(),['class'=>'form-control'])!!}
  </div>


  <div class="form-group">
  {!!form::label('Std village','Village:')!!}
  {!!form::text('village',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('Std Gewog','Gewog:')!!}
  {!!form::text('gewog',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('Std Dzongkhag','Dzongkhag:')!!}
  {!!form::Select('dzongkhag',array('Bumthang'=>'Bumthang','Chhukha'=>'Chhukha','Dagana'=>'Dagana','Gasa'=>'Gasa','Haa'=>'Haa','Lhuentse'=>'Lhuentse','Paro'=>'Paro','Pema Gatshel'=>'Pema Gatshel','Punakha'=>'Punakha','	Samdrup Jongkhar'=>'Samdrup Jongkhar','Samtse'=>'Samtse','Sarpang'=>'Sarpang','Tashi Yangtse'=>'Tashi Yangtse','Thimphu'=>'Thimphu','Trashigang'=>'Trashigang','Trongsa'=>'Trongsa','Tsirang'=>'Tsirang','Wangdue Phodrang'=>'Wangdue Phodrang','Zhemgang'=>'Zhemgang'),null,['class'=>'form-control','placeholder' => 'Select Dzongkhag...'])!!}
  </div>

  <div class="form-group">
  {!!form::label('Std mother',"Mother's Name:")!!}
  {!!form::text('mother_name',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('Std father',"Father's Name:")!!}
  {!!form::text('father_name',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('father occupation',"Father's Occupation:")!!}
  {!!form::text('father_occupation',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('mother occupation',"Mother's Occupation:")!!}
  {!!form::text('mother_occupation',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('guardiancontact',"Guardian's contact (comma seperated list):")!!}
  {!!form::textarea('guardian_contact',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('std_email',"Student's Email:")!!}
  {!!form::text('email',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('datejoin',"School Joining Date:")!!}
  {!!form::date('date_of_joining_school',\Carbon\Carbon::now(),['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('class join',"class when joined school:")!!}
  {!!form::text('class_when_joining_school',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('current class',"Current Class:")!!}
  {!!form::text('current_class',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('current section',"Section:")!!}
    {!!form::Select('current_section',array('A' => 'A', 'B' => 'B','B' => 'B','C' => 'C','D' => 'D','E' => 'E','F' => 'F'),'',['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('old school',"Previous schools(Comma seperated list):")!!}
  {!!form::textarea('previous_schools',null,['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('hostel',"Border/Dayscholar:")!!}
  {!!form::Select('hostel_status',array('Dayscholar' => 'Dayscholar', 'Border' => 'Border'),'Border',['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('House Group',"House:")!!}
  {!!form::Select('house',array('Dongemtse' => 'Dongemtse', 'Jarog' => 'Jarog','Tshenden' => 'Tshenden','Tsherngoen' => 'Tsherngoen'),'Tshenden',['class'=>'form-control'])!!}
  </div>

  <div class="form-group">
  {!!form::label('Upload Image','Upload image')!!}
  {!! Form::file('image', ['class' => 'jimage','id'=>'jimage','onchange'=>"document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" ]) !!}
  <img id="blah" width="200px"  />
  </div>


<div class="form-group">
{!!form::submit($submitButtonText,['class'=>'btn btn-primary form-control'])!!}
</div>

@section('footer')

@endsection
