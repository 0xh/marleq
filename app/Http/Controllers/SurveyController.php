<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;
use Session;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::orderBy('id', 'asc')->paginate(15);
        return view('manage.surveys.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $survey = new Survey();
        $survey->name = $request->name;

        if($survey->save()) {
            Session::flash('success', 'Survey has been successfully created');
            return redirect()->route('surveys.show', $survey->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this survey.');
            return redirect()->route('surveys.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $survey = Survey::findOrFail($id);
        return view('manage.surveys.show', compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        return view('manage.surveys.edit', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $survey = Survey::findOrFail($id);
        $survey->name = $request->name;

        if($survey->save()) {
            Session::flash('success', 'Survey has been successfully updated');
            return redirect()->route('surveys.show', $survey->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this survey.');
            return redirect()->route('surveys.edit', $survey->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Survey::destroy($id);
    }
}
