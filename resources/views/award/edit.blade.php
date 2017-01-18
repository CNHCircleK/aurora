@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$award->name}}</div>

                    <div class="panel-body">
                        {!! BootForm::open()->action(action('AwardController@update', $award->slug))->patch() !!}
                        {!! BootForm::text('Name', 'name', $award->name) !!}
                        {!! BootForm::text('Slug', 'slug', $award->slug) !!}
                        <div class="form-group">
                            {!! Form::label('Description') !!}
                            {!! Form::textarea('description', $award->description, ['class' => 'form-control', 'id' => 'description']) !!}
                        </div>
                        {!! BootForm::date('Open', 'open', $award->open) !!}
                        {!! BootForm::date('Deadline', 'deadline', $award->deadline) !!}
                        {!! BootForm::submit('Save') !!}
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