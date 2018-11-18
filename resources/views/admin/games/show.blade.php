@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.games.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.games.fields.team1')</th>
                            <td field-key='team1'>{{ $game->team1->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.games.fields.team2')</th>
                            <td field-key='team2'>{{ $game->team2->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.games.fields.results1')</th>
                            <td field-key='results1'>{{ $game->results1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.games.fields.results2')</th>
                            <td field-key='results2'>{{ $game->results2 }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#score" aria-controls="score" role="tab" data-toggle="tab">Score</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="score">
<table class="table table-bordered table-striped {{ count($scores) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.score.fields.games')</th>
                        <th>@lang('quickadmin.score.fields.players')</th>
                        <th>@lang('quickadmin.score.fields.rules')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($scores) > 0)
            @foreach ($scores as $score)
                <tr data-entry-id="{{ $score->id }}">
                    <td field-key='games'>{{ $score->games->results1 ?? '' }}</td>
                                <td field-key='players'>{{ $score->players->name ?? '' }}</td>
                                <td field-key='rules'>{{ $score->rules->name ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('score_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.scores.restore', $score->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('score_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.scores.perma_del', $score->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('score_view')
                                    <a href="{{ route('admin.scores.show',[$score->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('score_edit')
                                    <a href="{{ route('admin.scores.edit',[$score->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('score_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.scores.destroy', $score->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.games.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


