@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! BootForm::open()->action(action('UserController@update', Auth::user()))->patch()  !!}
                        {!! BootForm::text('Name', 'name', $user->name) !!}
                        {!! BootForm::text('Email', 'email', $user->email) !!}
                        {!! BootForm::password('Password', 'password') !!}
                        {!! BootForm::password('Password Confirmation', 'password_confirmation') !!}
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
