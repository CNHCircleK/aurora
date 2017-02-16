@extends('layouts.app')

@section('title', 'Invite Users')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! BootForm::open()->action(action('InviteController@createConfirm')) !!}
                        {!! BootForm::textarea('Emails (separated by new line)', 'emails') !!}
                        {!! BootForm::submit('Next') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
