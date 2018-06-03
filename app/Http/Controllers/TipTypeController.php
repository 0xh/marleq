<?php

namespace App\Http\Controllers;

use App\TipType;
use Illuminate\Http\Request;
use Session;

class TipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipTypes = TipType::orderBy('id', 'asc')->paginate(15);
        return view('manage.free-cv.types.index', compact('tipTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.free-cv.types.create');
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

        $type = new TipType();
        $type->name = $request->name;
        $type->description = $request->description;

        if($type->save()) {
            Session::flash('success', 'Type has been successfully created');
            return redirect()->route('tip-types.show', $type->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this type.');
            return redirect()->route('tip-types.create');
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
        $type = TipType::findOrFail($id);
        return view('manage.free-cv.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = TipType::findOrFail($id);
        return view('manage.free-cv.types.edit', compact('type'));
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

        $type = TipType::findOrFail($id);
        $type->name = $request->name;
        $type->description = $request->description;

        if($type->save()) {
            Session::flash('success', 'Type has been successfully updated');
            return redirect()->route('tip-types.show', $type->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this type.');
            return redirect()->route('tip-types.edit', $type->id);
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
        TipType::destroy($id);
    }
}
