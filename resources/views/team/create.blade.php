@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Team</div>

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
