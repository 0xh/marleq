<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use Session;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('id', 'asc')->paginate(15);
        return view('manage.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.testimonials.create');
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
            'testimonial_content' => 'required|string'
        ]);

        $testimonial = new Testimonial();
        $testimonial->content = $request->testimonial_content;
        $testimonial->featured = $request->featured;
        $testimonial->user_id = $request->user;
        $testimonial->reviewed = 0;

        if($testimonial->save()) {
            Session::flash('success', 'Testimonial has been successfully created');
            return redirect()->route('testimonials.show', $testimonial->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this testimonial.');
            return redirect()->route('testimonials.create');
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
        $testimonial = Testimonial::findOrFail($id);
        return view('manage.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('manage.testimonials.edit', compact('testimonial'));
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
            'testimonial_content' => 'required|string'
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->content = $request->testimonial_content;
        $testimonial->featured = $request->featured;
        $testimonial->reviewed = 1;

        if($testimonial->save()) {
            Session::flash('success', 'Testimonial has been successfully updated');
            return redirect()->route('testimonials.show', $testimonial->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this testimonial.');
            return redirect()->route('testimonials.edit', $testimonial->id);
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
        Testimonial::destroy($id);
    }
}
