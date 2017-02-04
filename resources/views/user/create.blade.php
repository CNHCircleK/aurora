@extends('layouts.app')

@section('title', 'Create User')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! BootForm::open()->action(action('UserController@store'))  !!}
                        {!! BootForm::text('Name', 'name', old('name')) !!}
                        {!! BootForm::text('Email', 'email', old('email')) !!}
                        {!! BootForm::password('Password', 'password') !!}
                        {!! BootForm::password('Password Confirmation', 'password_confirmation') !!}
                        {!! BootForm::checkbox('Generate Password', 'generate_pw') !!}
                        <div class="pull-right">
                            {!! BootForm::submit('Save Settings', 'btn-success') !!}
                        </div>
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
