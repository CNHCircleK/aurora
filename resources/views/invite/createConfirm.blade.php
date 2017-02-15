@extends('layouts.app')

@section('title', 'Invite Users')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><strong>{{ $email_count }} emails</strong></p>
                        {!! BootForm::open()->action(action('InviteController@store')) !!}
                        @foreach ($emails as $email)
                            <div class="form-group">
                                <input type="email" name="emails[]" value="{{ $email }}" class="form-control">
                            </div>
                        @endforeach
                        {!! BootForm::submit('Send Invites', 'btn btn-success') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
