@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.score.title')</h3>
    
    {!! Form::model($score, ['method' => 'PUT', 'route' => ['admin.scores.update', $score->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('games_id', trans('quickadmin.score.fields.games').'', ['class' => 'control-label']) !!}
                    {!! Form::select('games_id', $games, old('games_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('games_id'))
                        <p class="help-block">
                            {{ $errors->first('games_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('players_id', trans('quickadmin.score.fields.players').'', ['class' => 'control-label']) !!}
                    {!! Form::select('players_id', $players, old('players_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('players_id'))
                        <p class="help-block">
                            {{ $errors->first('players_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('rules_id', trans('quickadmin.score.fields.rules').'', ['class' => 'control-label']) !!}
                    {!! Form::select('rules_id', $rules, old('rules_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('rules_id'))
                        <p class="help-block">
                            {{ $errors->first('rules_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

