<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;
use Session;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::orderBy('id', 'asc')->paginate(15);
        return view('manage.levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.levels.create');
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

        $level = new Level();
        $level->name = $request->name;

        if($level->save()) {
            Session::flash('success', 'Level has been successfully created');
            return redirect()->route('levels.show', $level->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this level.');
            return redirect()->route('levels.create');
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
        $level = Level::findOrFail($id);
        return view('manage.levels.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('manage.levels.edit', compact('level'));
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

        $level = Level::findOrFail($id);
        $level->name = $request->name;

        if($level->save()) {
            Session::flash('success', 'Level has been successfully updated');
            return redirect()->route('levels.show', $level->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this level.');
            return redirect()->route('levels.edit', $level->id);
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
        //
    }
}
