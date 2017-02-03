@extends('layouts.app')

@section('title', 'Create' . trans_choice('team.teams', 1))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! BootForm::open()->action(action('TeamController@store')) !!}
                        {!! BootForm::text('Name', 'name') !!}
                        {!! BootForm::submit('Create') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
