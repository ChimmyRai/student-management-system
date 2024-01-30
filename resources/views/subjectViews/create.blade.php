@extends('layouts.subjectAllocation')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('errors.listerrors')
            <div class="card">
                <div class="card-header">Enter subject-teacher detials</div>
                <div class="card-body">
                  {!! Form::open(['url'=>'AllocatedSubject','files' => true]) !!}

                  <div class="form-group">
                  {!!form::label('Teacher Name','Name of the teacher:')!!}
                  {!! Form::select('Teacher_Name', $instructorOptions, null, ['class' => 'form-control']) !!}

                  </div>
                  <div class="form-group">
                  {!!form::label('Subject',"Subject:")!!}
                    {!!form::Select('Subject',array('English' => 'English', 'Dzongkhag' => 'Dzongkhag','Math' => 'Math','History' => 'History','Geography' => 'Geography','Science' => 'Science','Biology' => 'Biology','Chemistry' => 'Chemistry','Physics' => 'Physics','Environemental Science' => 'Environemental Science','ICT' => 'ICT',
                    'Business Math' => 'Business Math','Media Studies' => 'Media Studies','Rigzhung' => 'Rigzhung'),'',['class'=>'form-control'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('Class',"Class:")!!}
                  {!!form::Select('Class',array('7' => 'VII', '8' => 'VIII','9'=>'IX','10'=>'X','11'=>'XI'),null,['class'=>'form-control','placeholder' => 'Select class...'])!!}
                  </div>
                  <div class="form-group">
                  {!!form::label('current section',"Section:")!!}
                    {!!form::Select('Section',array('A' => 'A', 'B' => 'B','B' => 'B','C' => 'C','D' => 'D','Science A' => 'Science A','F' => 'F','Science B' => 'Science B','Arts A' => 'Arts A','Arts B' => 'Arts B','Commerce'=>'Commerce'),'',['class'=>'form-control'])!!}
                  </div>

                  <div class="form-group">
                  {!!form::submit('Allocate',['class'=>'btn btn-primary form-control'])!!}
                  </div>
                  {!! Form::close() !!}







                </div>
            </div>
        </div>
    </div>
</div>
@endsection
