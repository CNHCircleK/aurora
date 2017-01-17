@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Invites
                        @can('create', App\Invite::class)
                            <span class="pull-right">
                            <a href="{{action('InviteController@create')}}"
                               class="btn btn-success btn-sm">Invite</a>
                        </span>
                        @endcan
                    </div>

                    <div class="panel-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Accepted</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($invites as $invite)
                                <tr>
                                    <td>
                                        {{$invite->email}}
                                    </td>
                                    <td>
                                        @if($invite->accepted)
                                            {{ $invite->accepted }}
                                        @else
                                            <i class="glyphicon glyphicon-remove text-danger"></i>
                                        @endif
                                    </td>
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
