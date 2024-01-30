@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('errors.listerrors')
            <div class="card">
                <div class="card-header">Enter Staff Details</div>
                <div class="card-body">
                  {!! Form::open(['url'=>'staffdetail','files' => true]) !!}

                  <div class="form-group">
                  {!!form::label('Citizen ID','Citizen ID:')!!}
                  {!!form::number('cid',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Employee ID','Employee ID:')!!}
                  {!!form::number('eid',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Staff Name','Name:')!!}
                  {!!form::text('Name',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Date of birth','DOB:')!!}
                  {!!form::date('dob',\Carbon\Carbon::now(),['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('gender','Sex:')!!}
                  {!!form::Select('gender',array('male' => 'male', 'female' => 'female'),'',['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('nationality','Nationality:')!!}
                  {!!form::text('Nationality','Bhutanese',['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Grade',"Grade:")!!}
                  {!!form::Select('grade',array('VIII' => 'VIII', 'VII' => 'VII','VI'=>'VI','V'=>'V','IV'=>'IV','X'=>'X','XI'=>'XI','XII'=>'XII','XIII'=>'XIII','GSP-I'=>'GSP-I','GSP-II'=>'GSP-II','GSC-I'=>'GSC-I','GSC-II'=>'GSC-II','ESP'=>'ESP'),null,['class'=>'form-control','placeholder' => 'Select grade...'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Position Level',"Position Level:")!!}
                  {!!form::Select('position_level',array('P1A'=>'P1A','P2A'=>'P2A','P3A'=>'P3A','P4A'=>'P4A','P5A'=>'P5A','S1A'=>'S1A','S2A'=>'S2A','S3A'=>'S3A','S4A'=>'S4A','S5A'=>'S5A','O1A'=>'O1A','O2A'=>'O2A','O3A'=>'O3A','O4A'=>'O4A'),null,['class'=>'form-control','placeholder' => 'Select Position Level...'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Position Title',"Position Title:")!!}
                  {!!form::Select('position_title',array('Principal' => 'Principal', 'Vice Principal' => 'Vice Principal','Senior Teacher I'=>'Senior Teacher I','Teacher I'=>'Teacher I','Senior Teacher II'=>'Senior Teacher II','Teacher II'=>'Teacher II','Teacher III'=>'Teacher III','Chief Counselor'=>'Chief Counselor','Deputy Chief Counselor'=>'Deputy Chief Counselor','Counselor'=>'Counselor','Sports Instructor'=>'Sports Instructor','Lab Assitant'=>'Lab Assitant','Adm Assitant'=>'Adm Assitant','Lib Assitant'=>'Lib Assitant','Store Assitant'=>'Store Assitant','Warden'=>'Warden','Matron'=>'Matron','Cook'=>'Cook','Sweeper'=>'Sweeper','Caretaker'=>'Caretaker'),null,['class'=>'form-control','placeholder' => 'Select position title...'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Phone No',"Phone No:")!!}
                  {!!form::text('contact_number',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('qualification',"Qualification(use comma seperated list):")!!}
                  {!!form::text('Qualification',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('subject specialized',"Subject Specialization:")!!}
                  {!!form::text('subject_specilization',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('DOA','Date of Appointment:')!!}
                  {!!form::date('date_of_appointment',\Carbon\Carbon::now(),['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Staff village','Village:')!!}
                  {!!form::text('village',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Staff Gewog','Gewog:')!!}
                  {!!form::text('gewog',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Staff Dzongkhag','Dzongkhag:')!!}
                  {!!form::Select('dzongkhag',array('Bumthang'=>'Bumthang','Chhukha'=>'Chhukha','Dagana'=>'Dagana','Gasa'=>'Gasa','Haa'=>'Haa','Lhuentse'=>'Lhuentse','Paro'=>'Paro','Pema Gatshel'=>'Pema Gatshel','Punakha'=>'Punakha','	Samdrup Jongkhar'=>'Samdrup Jongkhar','Samtse'=>'Samtse','Sarpang'=>'Sarpang','Tashi Yangtse'=>'Tashi Yangtse','Thimphu'=>'Thimphu','Trashigang'=>'Trashigang','Trongsa'=>'Trongsa','Tsirang'=>'Tsirang','Wangdue Phodrang'=>'Wangdue Phodrang','Zhemgang'=>'Zhemgang'),null,['class'=>'form-control','placeholder' => 'Select Dzongkhag...'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('staff_email',"Staff's Email:")!!}
                  {!!form::text('email',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('old school',"Previous schools served(Comma seperated list):")!!}
                  {!!form::textarea('previous_schools_served',null,['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Upload Image','Upload image')!!}
                  {!! Form::file('image', ['class' => 'jimage','id'=>'jimage','onchange'=>"document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" ]) !!}
                  <img id="blah" width="200px"  />
                  </div>
                  <div class="form-group">
                  {!!form::submit('Add details',['class'=>'btn btn-primary form-control'])!!}
                  </div>
                  {!! Form::close() !!}







                </div>
            </div>
        </div>
    </div>
</div>
@endsection
