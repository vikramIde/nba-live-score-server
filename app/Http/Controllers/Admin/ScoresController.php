<?php

namespace App\Http\Controllers\Admin;

use App\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScoresRequest;
use App\Http\Requests\Admin\UpdateScoresRequest;

class ScoresController extends Controller
{
    /**
     * Display a listing of Score.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('score_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('score_delete')) {
                return abort(401);
            }
            $scores = Score::onlyTrashed()->get();
        } else {
            $scores = Score::all();
        }

        return view('admin.scores.index', compact('scores'));
    }

    /**
     * Show the form for creating new Score.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('score_create')) {
            return abort(401);
        }
        
        $games = \App\Game::get()->pluck('results1', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $players = \App\Player::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $rules = \App\Rule::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.scores.create', compact('games', 'players', 'rules'));
    }

    /**
     * Store a newly created Score in storage.
     *
     * @param  \App\Http\Requests\StoreScoresRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoresRequest $request)
    {
        if (! Gate::allows('score_create')) {
            return abort(401);
        }
        $score = Score::create($request->all());

        return redirect()->route('admin.scores.index');
    }


    /**
     * Show the form for editing Score.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('score_edit')) {
            return abort(401);
        }
        
        $games = \App\Game::get()->pluck('results1', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $players = \App\Player::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $rules = \App\Rule::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $score = Score::findOrFail($id);

        return view('admin.scores.edit', compact('score', 'games', 'players', 'rules'));
    }

    /**
     * Update Score in storage.
     *
     * @param  \App\Http\Requests\UpdateScoresRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScoresRequest $request, $id)
    {
        if (! Gate::allows('score_edit')) {
            return abort(401);
        }
        $score = Score::findOrFail($id);
        $score->update($request->all());

        return redirect()->route('admin.scores.index');
    }


    /**
     * Display Score.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('score_view')) {
            return abort(401);
        }
        $score = Score::findOrFail($id);

        return view('admin.scores.show', compact('score'));
    }


    /**
     * Remove Score from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('score_delete')) {
            return abort(401);
        }
        $score = Score::findOrFail($id);
        $score->delete();

        return redirect()->route('admin.scores.index');
    }

    /**
     * Delete all selected Score at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('score_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Score::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Score from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('score_delete')) {
            return abort(401);
        }
        $score = Score::onlyTrashed()->findOrFail($id);
        $score->restore();

        return redirect()->route('admin.scores.index');
    }

    /**
     * Permanently delete Score from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('score_delete')) {
            return abort(401);
        }
        $score = Score::onlyTrashed()->findOrFail($id);
        $score->forceDelete();

        return redirect()->route('admin.scores.index');
    }
}
