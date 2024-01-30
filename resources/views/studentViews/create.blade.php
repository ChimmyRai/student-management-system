@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
              @include('errors.listerrors')
            <div class="card">
                <div class="card-header">Enter New Student Details</div>

                <div class="card-body">


                  {!! Form::open(['url'=>'studentbio','files' => true]) !!}
                  @include('studentViews._partialform',['submitButtonText'=>'Add student','imageOperation'=>'Upload Image'])
                  {!! Form::close() !!}



                </div>
            </div>
        </div>
    </div>
</div>
@stop
