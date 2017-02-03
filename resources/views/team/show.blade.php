@extends('layouts.app')

@section('title', $team->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p><strong>Owner:</strong> {{$team->owner->name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
