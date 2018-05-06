<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Level;
use App\Service;
use Illuminate\Http\Request;
use Session;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $costs = Cost::orderBy('service_id', 'asc')->paginate(15);
        return view('manage.costs.index', compact('costs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $levels = Level::all();
        return view('manage.costs.create', compact('services', 'levels'));
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
            'price' => 'required',
            'description' => 'required'
        ]);

        $cost = new Cost();
        $cost->price = $request->price;
        $cost->description = $request->description;
        $cost->level_id = $request->level;
        $cost->service_id = $request->service;

        if($cost->save()) {
            Session::flash('success', 'Cost has been successfully created');
            return redirect()->route('costs.show', $cost->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this cost.');
            return redirect()->route('costs.create');
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
        $cost = Cost::findOrFail($id);
        return view('manage.costs.show', compact('cost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cost = Cost::findOrFail($id);
        return view('manage.costs.edit', compact('cost'));
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
            'price' => 'required',
            'description' => 'required'
        ]);

        $cost = Cost::findOrFail($id);
        $cost->price = $request->price;
        $cost->description = $request->description;
        $cost->level_id = $request->level;
        $cost->service_id = $request->service;

        if($cost->save()) {
            Session::flash('success', 'Cost has been successfully updated');
            return redirect()->route('costs.show', $cost->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this cost.');
            return redirect()->route('costs.edit', $cost->id);
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
        Cost::destroy($id);
    }
}
