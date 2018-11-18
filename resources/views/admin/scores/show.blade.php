@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.score.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.score.fields.games')</th>
                            <td field-key='games'>{{ $score->games->results1 ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.score.fields.players')</th>
                            <td field-key='players'>{{ $score->players->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.score.fields.rules')</th>
                            <td field-key='rules'>{{ $score->rules->name ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.scores.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


