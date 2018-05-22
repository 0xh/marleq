<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Post;
use App\Service;
use App\Testimonial;
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
     * Show the application Homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coaches = User::whereRoleIs('coach')->where('featured', 1)->where('status', 1)->get();
        $featuredServices = Service::where('featured', 1)->get();
        $services = Service::where('featured', '!=', 1)->get();
        $inspiration = Category::where('name', 'Inspiration')->with(['posts' => function($query){
            return $query->where('status', 0)->where('featured', 1)->take(3);
        }])->first();
        $events = Category::where('name', 'Events')->with(['posts' => function($query){
            return $query->where('status', 0)->where('featured', '1')->orderBy('id', 'desc')->take(3);
        }])->first();
        $testimonials = Testimonial::where('featured', 1)->get();

        return view('welcome', compact('coaches', 'services', 'featuredServices', 'inspiration', 'events', 'testimonials'));
    }

    /**
     * Show the application About Us Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutUs()
    {
        $team = User::whereRoleIs('administrator')->where('status', 1)->get();
        return view('about-us', compact('team'));
    }

    /**
     * Show the application Inspiration Index Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function inspirationIndex()
    {
        $posts = Category::where('name', 'Inspiration')->with('posts')->first();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the application Inspiration Show Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function inspirationShow($alias)
    {
        $post = Post::where('alias', $alias)->first();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the application Events Index Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventsIndex()
    {
        $posts = Category::where('name', 'Events')->with('posts')->first();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the application Events Show Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventShow($alias)
    {
        $post = Post::where('alias', $alias)->first();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the application Services Index Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function servicesIndex()
    {
        $featuredServices = Service::where('featured', 1)->get();
        $services = Service::where('featured', '!=', 1)->get();
        return view('services.index', compact('services', 'featuredServices'));
    }

    /**
     * Show the application Service Show Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceShow($alias)
    {
        $featuredServices = Service::where('featured', 1)->get();
        $services = Service::where('featured', '!=', 1)->get();
        $service = Service::where('alias', $alias)->first();
        $costs = Cost::where('service_id', $service->id)->get();
        $serviceId = $service->id;
        $coaches = User::whereRoleIs('coach')->where('status', 1)->whereHas('services', function ($query) use ($serviceId) {
            $query->where('service_id', $serviceId);
        })->get()->take(4);

        return view('services.show', compact('service', 'services', 'featuredServices', 'costs', 'coaches'));
    }

    /**
     * Show the application Find A Coach Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function findACoach()
    {
        $coaches = User::whereRoleIs('coach')->where('status', 1)->get();

        return view('coaches.index', compact('coaches'));
    }

    public function coachShow($alias)
    {
        $coach = User::whereRoleIs('coach')->where('alias', $alias)->first();
        if($coach->status == 1)
            return view('coaches.show', compact('coach'));
        else
            return redirect()->route('home');
    }
}
