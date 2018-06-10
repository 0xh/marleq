<?php

namespace App\Http\Controllers;

use App\Notifications\FreeCVResults;
use App\Resume;
use App\TipType;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumes = Resume::orderBy('id', 'asc')->paginate(25);
        return view('manage.free-cv.index', compact('resumes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resume = Resume::findOrFail($id);
        return view('manage.free-cv.show', compact('resume'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resume = Resume::findOrFail($id);
        $tipTypes = TipType::all();

        return view('manage.free-cv.edit', compact('resume', 'tipTypes'));
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
        $resume = Resume::findOrFail($id);

        $resume->coach_id = Auth::user()->id;
        $resume->status = 1;
        $resume->rating = $request->rating;

        if($resume->save()){
            if($request->tips) {
                DB::transaction(function () use ($resume, $request) {
                    $resume->tips()->sync(explode(',', $request->tips));
                }, 5);
            }

            $user = User::findOrFail($resume->user_id);

            $user->free_cv = 2;
            $user->save();

            $user->notify(new FreeCVResults($user));

            Session::flash('success', 'Resume has been successfully edited');
            return redirect()->route('resumes.show', $resume->id);
        } else {
            return redirect()->route('resumes.edit', $resume->id);
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
        Resume::destroy($id);
    }
}
