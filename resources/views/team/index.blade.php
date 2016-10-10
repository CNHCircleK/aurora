@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Teams</div>

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
                                    <td><a href="{{action('AwardController@show', ['slug' => $team->slug])}}">{{$team->name}}</a></td>
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
