@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Awards</div>

                    <div class="panel-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Open</th>
                                <th>Deadline</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($awards as $award)
                                <tr>
                                    <td><a href="{{action('AwardController@show', ['slug' => $award->slug])}}">{{$award->name}}</a></td>
                                    <td>{{$award->description}}</td>
                                    <td>{{$award->open}}</td>
                                    <td>{{$award->deadline}}</td>
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
