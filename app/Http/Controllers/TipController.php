<?php

namespace App\Http\Controllers;

use App\Tip;
use App\TipType;
use Illuminate\Http\Request;
use Session;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tips = Tip::orderBy('id', 'asc')->paginate(25);
        return view('manage.free-cv.tips.index', compact('tips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TipType::all();
        return view('manage.free-cv.tips.create', compact('types'));
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
            'type' => 'required'
        ]);

        $tip = new Tip();
        $tip->content = $request->name;
        $tip->tip_type_id = $request->type;

        if($tip->save()) {
            Session::flash('success', 'Tip has been successfully created');
            return redirect()->route('tips.show', $tip->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this tip.');
            return redirect()->route('tips.create');
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
        $tip = Tip::findOrFail($id);
        return view('manage.free-cv.tips.show', compact('tip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tip = Tip::findOrFail($id);
        $types = TipType::all();
        return view('manage.free-cv.tips.edit', compact('tip', 'types'));
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
            'type' => 'required'
        ]);

        $tip = Tip::findOrFail($id);
        $tip->content = $request->name;
        $tip->tip_type_id = $request->type;

        if($tip->save()) {
            Session::flash('success', 'Tip has been successfully updated');
            return redirect()->route('tips.show', $tip->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this tip.');
            return redirect()->route('tips.edit', $tip->id);
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
        Tip::destroy($id);
    }
}
