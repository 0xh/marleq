<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use Session;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialties = Specialty::orderBy('id', 'asc')->paginate(15);
        return view('manage.specialties.index', compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.specialties.create');
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

        $specialty = new Specialty();
        $specialty->name = $request->name;

        if($specialty->save()) {
            Session::flash('success', 'Specialty has been successfully created');
            return redirect()->route('specialties.show', $specialty->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this specialty.');
            return redirect()->route('specialties.create');
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
        $specialty = Specialty::findOrFail($id);
        return view('manage.specialties.show', compact('specialty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);
        return view('manage.specialties.edit', compact('specialty'));
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

        $specialty = Specialty::findOrFail($id);
        $specialty->name = $request->name;

        if($specialty->save()) {
            Session::flash('success', 'Specialty has been successfully updated');
            return redirect()->route('specialties.show', $specialty->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this specialty.');
            return redirect()->route('specialties.edit', $specialty->id);
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
        Specialty::destroy($id);
    }
}
