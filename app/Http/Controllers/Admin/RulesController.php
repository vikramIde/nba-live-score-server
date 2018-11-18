<?php

namespace App\Http\Controllers\Admin;

use App\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRulesRequest;
use App\Http\Requests\Admin\UpdateRulesRequest;

class RulesController extends Controller
{
    /**
     * Display a listing of Rule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('rule_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('rule_delete')) {
                return abort(401);
            }
            $rules = Rule::onlyTrashed()->get();
        } else {
            $rules = Rule::all();
        }

        return view('admin.rules.index', compact('rules'));
    }

    /**
     * Show the form for creating new Rule.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('rule_create')) {
            return abort(401);
        }
        return view('admin.rules.create');
    }

    /**
     * Store a newly created Rule in storage.
     *
     * @param  \App\Http\Requests\StoreRulesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRulesRequest $request)
    {
        if (! Gate::allows('rule_create')) {
            return abort(401);
        }
        $rule = Rule::create($request->all());



        return redirect()->route('admin.rules.index');
    }


    /**
     * Show the form for editing Rule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('rule_edit')) {
            return abort(401);
        }
        $rule = Rule::findOrFail($id);

        return view('admin.rules.edit', compact('rule'));
    }

    /**
     * Update Rule in storage.
     *
     * @param  \App\Http\Requests\UpdateRulesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRulesRequest $request, $id)
    {
        if (! Gate::allows('rule_edit')) {
            return abort(401);
        }
        $rule = Rule::findOrFail($id);
        $rule->update($request->all());



        return redirect()->route('admin.rules.index');
    }


    /**
     * Display Rule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('rule_view')) {
            return abort(401);
        }
        $scores = \App\Score::where('rules_id', $id)->get();

        $rule = Rule::findOrFail($id);

        return view('admin.rules.show', compact('rule', 'scores'));
    }


    /**
     * Remove Rule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('rule_delete')) {
            return abort(401);
        }
        $rule = Rule::findOrFail($id);
        $rule->delete();

        return redirect()->route('admin.rules.index');
    }

    /**
     * Delete all selected Rule at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('rule_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Rule::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Rule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('rule_delete')) {
            return abort(401);
        }
        $rule = Rule::onlyTrashed()->findOrFail($id);
        $rule->restore();

        return redirect()->route('admin.rules.index');
    }

    /**
     * Permanently delete Rule from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('rule_delete')) {
            return abort(401);
        }
        $rule = Rule::onlyTrashed()->findOrFail($id);
        $rule->forceDelete();

        return redirect()->route('admin.rules.index');
    }
}
