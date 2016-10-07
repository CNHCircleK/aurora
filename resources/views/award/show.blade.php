@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$award->name}}</div>

                    <div class="panel-body">
                        <p><strong>Opens: </strong> {{$award->open}}</p>

                        <p><strong>Deadline: </strong> {{$award->deadline}}</p>

                        {{$award->description}}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Make a Submission
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['action' => 'SubmissionController@store', 'files' => true]) !!}
                        {!! Form::file('file') !!}
                        {!! Form::hidden('award_id', $award->id) !!}
                        <br />
                        {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
