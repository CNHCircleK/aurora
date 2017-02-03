@extends('layouts.app')

@section('title', 'Awards')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    @can('create', App\Award::class)
                        <div class="panel-heading clearfix">
                            <span class="pull-right">
                            <a href="{{action('AwardController@create')}}"
                               class="btn btn-success btn-sm">Create Award</a>
                        </span>
                        </div>
                    @endcan

                    <div class="panel-body">
                        <div class="row">
                            @foreach($awards as $award)
                                <div class="col-sm-6 col-md-4">
                                    <a href="{{action('AwardController@show', ['slug' => $award->slug])}}"
                                       class="award-item">
                                        <div class="panel panel-rounded panel-primary">
                                            <div class="panel-body">
                                                <h2>{{$award->name}}</h2>
                                            </div>
                                            <div class="panel-footer">
                                                <small>
                                                    Due {{ (new \Carbon\Carbon($award->deadline))->format('l, F j, Y h:i A') }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
