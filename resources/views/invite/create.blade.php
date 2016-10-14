@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Invite Users</div>

                    <div class="panel-body">
                        {!! BootForm::open()->action(action('InviteController@store')) !!}
                        {!! BootForm::textarea('Emails', 'emails') !!}
                        {!! BootForm::submit('Send Invites') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
