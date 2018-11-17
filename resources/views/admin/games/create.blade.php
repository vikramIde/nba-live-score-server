@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.games.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.games.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('team1_id', trans('quickadmin.games.fields.team1').'', ['class' => 'control-label']) !!}
                    {!! Form::select('team1_id', $team1s, old('team1_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('team1_id'))
                        <p class="help-block">
                            {{ $errors->first('team1_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('team2_id', trans('quickadmin.games.fields.team2').'', ['class' => 'control-label']) !!}
                    {!! Form::select('team2_id', $team2s, old('team2_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('team2_id'))
                        <p class="help-block">
                            {{ $errors->first('team2_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('results1', trans('quickadmin.games.fields.results1').'', ['class' => 'control-label']) !!}
                    {!! Form::number('results1', old('results1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('results1'))
                        <p class="help-block">
                            {{ $errors->first('results1') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('results2', trans('quickadmin.games.fields.results2').'', ['class' => 'control-label']) !!}
                    {!! Form::number('results2', old('results2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('results2'))
                        <p class="help-block">
                            {{ $errors->first('results2') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

