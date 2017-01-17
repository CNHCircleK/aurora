@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$award->name}}</div>

                    <div class="panel-body">
                        <p><strong>Opens: </strong> {{$award->open}}</p>

                        <p><strong>Deadline: </strong> {{$award->deadline}}</p>

                        {{$award->description}}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Submit Files
                    </div>
                    <div class="panel-body">
                        <p>
                            You may submit as many files as necessary. You may also delete any files you no longer wish to be reviewed.
                        </p>
                        {!! Form::open(['action' => 'SubmissionController@store', 'files' => true]) !!}
                        {!! Form::file('files[]', ['multiple' => 'multiple']) !!}
                        {!! Form::hidden('award_id', $award->id) !!}
                        <br/>
                        {!! Form::submit('Submit', ['class' => 'btn btn-block btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

                @if(!$submissions->isEmpty())
                    @cannot('viewAll', App\Submission::class)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Submissions
                            </div>
                            <div class="panel-body">
                                <p>Click to expand</p>
                                <div class="panel-group" id="submission-list" role="tablist" aria-multiselectable="true">
                                    @foreach($submissions as $submission)
                                        <div class="panel panel-default">
                                            <div class="panel-default">
                                                <div class="panel-heading" role="tab" id="heading-{{$submission->id}}">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#submission-list" href="#collapse-{{$submission->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                            {{ $submission->orig_filename }}
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div id="collapse-{{$submission->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <object data="{{ Storage::url($submission->file) }}" type="application/pdf"
                                                            width="100%"
                                                            height="600px">
                                                        <iframe src="{{ Storage::url($submission->file) }}" width="100%" height="500px"
                                                                style="border: none;">
                                                            This browser does not support PDFs. Please download the PDF to view it: <a
                                                                    href="{{ Storage::url($submission->file) }}">Download PDF</a>
                                                        </iframe>
                                                    </object>
                                                    {{ Form::open(['action' => ['SubmissionController@destroy', $submission->id], 'method' => 'DELETE']) }}
                                                        <button class="btn btn-danger btn-block" type="submit">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                            Delete
                                                        </button>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endcannot
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
