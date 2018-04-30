<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coaches = User::whereRoleIs('administrator')->get();
        $featuredServices = Service::where('featured', 1)->get();
        $services = Service::where('featured', '!=', 1)->get();
//        dd($featuredServices);
        return view('welcome', compact('coaches', 'services', 'featuredServices'));
    }
}
