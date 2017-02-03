@extends('layouts.app')

@section('title', 'Edit ' . $team->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! BootForm::open()->action(action('TeamController@update', $team->id))->patch() !!}
                        {!! BootForm::text('Name', 'name', $team->name) !!}
                        {!! BootForm::submit('Save') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
