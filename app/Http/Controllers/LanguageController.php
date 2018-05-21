<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Session;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderBy('id', 'asc')->paginate(25);
        return view('manage.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.languages.create');
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

        $language = new Language();
        $language->name = $request->name;

        if($language->save()) {
            Session::flash('success', 'Language has been successfully created');
            return redirect()->route('languages.show', $language->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this language.');
            return redirect()->route('languages.create');
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
        $language = Language::findOrFail($id);
        return view('manage.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('manage.languages.edit', compact('language'));
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

        $language = Language::findOrFail($id);
        $language->name = $request->name;

        if($language->save()) {
            Session::flash('success', 'Language has been successfully updated');
            return redirect()->route('languages.show', $language->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this language.');
            return redirect()->route('languages.edit', $language->id);
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
        Language::destroy($id);
    }
}
