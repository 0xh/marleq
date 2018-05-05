<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use App\Category;
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
//        $this->middleware('auth');
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
        $inspiration = Category::where('name', 'Inspiration')->with(['posts' => function($query){
            return $query->where('status', '==', 0)->take(3);
        }])->first();
        $events = Category::where('name', 'Events')->with(['posts' => function($query){
            return $query->where('status', '==', 0)->take(3);
        }])->first();

        return view('welcome', compact('coaches', 'services', 'featuredServices', 'inspiration', 'events'));
    }
}
