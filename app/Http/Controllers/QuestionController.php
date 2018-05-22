<?php

namespace App\Http\Controllers;

use App\Question;
use App\Survey;
use Illuminate\Http\Request;
use Session;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('id', 'asc')->paginate(25);
        return view('manage.surveys.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surveys = Survey::all();
        return view('manage.surveys.questions.create', compact('surveys'));
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
            'name' => 'required|string|max:255',
            'survey' => 'required'
        ]);

        $question = new Question();
        $question->name = $request->name;
        $question->survey_id = $request->survey;

        if($question->save()) {
            Session::flash('success', 'Question has been successfully created');
            return redirect()->route('questions.show', $question->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this question.');
            return redirect()->route('questions.create');
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
        $question = Question::findOrFail($id);
        return view('manage.surveys.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $surveys = Survey::all();
        return view('manage.surveys.questions.edit', compact('question', 'surveys'));
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
            'name' => 'required|string|max:255',
            'survey' => 'required'
        ]);

        $question = Question::findOrFail($id);
        $question->name = $request->name;
        $question->survey_id = $request->survey;

        if($question->save()) {
            Session::flash('success', 'Question has been successfully updated');
            return redirect()->route('questions.show', $question->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this question.');
            return redirect()->route('questions.edit', $question->id);
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
        Question::destroy($id);
    }
}
