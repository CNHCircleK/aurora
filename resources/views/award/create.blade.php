@extends('layouts.app')

@section('title', 'Create Award')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! BootForm::open()->action(action('AwardController@store')) !!}
                        {!! BootForm::text('Name', 'name') !!}
                        {!! BootForm::textarea('Description', 'description') !!}
                        {!! BootForm::date('Open', 'open', \Carbon\Carbon::now()) !!}
                        {!! BootForm::date('Deadline', 'deadline') !!}
                        {!! BootForm::submit('Create') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-js')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: '#description',
        menubar: 'edit view format'
      });
    </script>
@endsection
