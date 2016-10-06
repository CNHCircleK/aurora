@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Award</div>

                    <div class="panel-body">
                        {!! BootForm::open()->action(action('AwardController@store')) !!}
                        {!! BootForm::text('Name', 'name') !!}
                        {!! BootForm::textarea('Description', 'description') !!}
                        {!! BootForm::date('Open', 'open') !!}
                        {!! BootForm::date('Deadline', 'deadline') !!}
                        {!! BootForm::submit('Create') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
