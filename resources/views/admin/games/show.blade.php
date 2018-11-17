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
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.games.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


