<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Session;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::orderBy('id', 'asc')->paginate(25);
        return view('manage.surveys.answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all();
        return view('manage.surveys.answers.create', compact('questions'));
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
            'question' => 'required'
        ]);

        $answer = new Answer();
        $answer->name = $request->name;
        $answer->question_id = $request->question;

        if($answer->save()) {
            Session::flash('success', 'Answer has been successfully created');
            return redirect()->route('answers.show', $answer->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this answer.');
            return redirect()->route('answers.create');
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
        $answer = Answer::findOrFail($id);
        return view('manage.surveys.answers.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $answer = Answer::findOrFail($id);
        $questions = Question::all();
        return view('manage.surveys.answers.edit', compact('answer', 'questions'));
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
            'question' => 'required'
        ]);

        $answer = Answer::findOrFail($id);
        $answer->name = $request->name;
        $answer->question_id = $request->question;

        if($answer->save()) {
            Session::flash('success', 'Answer has been successfully updated');
            return redirect()->route('answers.show', $answer->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this answer.');
            return redirect()->route('answers.edit', $answer->id);
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
        Answer::destroy($id);
    }
}
