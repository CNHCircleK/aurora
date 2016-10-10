@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$award->name}}</div>

                    <div class="panel-body">
                        <p><strong>Opens: </strong> {{$award->open}}</p>

                        <p><strong>Deadline: </strong> {{$award->deadline}}</p>

                        {{$award->description}}
                    </div>
                </div>


                @if(!$submissions->isEmpty())
                    @cannot('viewAll', App\Submission::class)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Submissions
                            </div>
                            <div class="panel-body">
                                @foreach($submissions as $submission)
                                    <object data="{{ Storage::url($submission->file) }}" type="application/pdf"
                                            width="100%"
                                            height="600px">
                                        <iframe src="{{ Storage::url($submission->file) }}" width="100%" height="500px"
                                                style="border: none;">
                                            This browser does not support PDFs. Please download the PDF to view it: <a
                                                    href="{{ Storage::url($submission->file) }}">Download PDF</a>
                                        </iframe>
                                    </object>
                                @endforeach
                            </div>
                        </div>
                    @endcannot
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Make a Submission
                        </div>
                        <div class="panel-body">
                            {!! Form::open(['action' => 'SubmissionController@store', 'files' => true]) !!}
                            {!! Form::file('file') !!}
                            {!! Form::hidden('award_id', $award->id) !!}
                            <br/>
                            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
