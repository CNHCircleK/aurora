@extends('layouts.app')

@section('title', trans_choice('team.teams', 2))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Owner</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($teams as $team)
                                <tr>
                                    <td>
                                        <a href="{{action('TeamController@show', $team->id)}}">{{$team->name}}</a>
                                    </td>
                                    <td>{{$team->owner->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
