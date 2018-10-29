<?php

namespace App\Http\Controllers;

use App\Cost;
use App\Country;
use App\Notifications\FreeCVRequest;
use App\Post;
use App\Resume;
use App\Service;
use App\Testimonial;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Auth;
use Session;
use Storage;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:user')->only('freeCVStore');
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
            return $query->where('status', 0)->where('featured', 1)->orderBy('id', 'desc')->take(4);
        }])->first();
        $events = Category::where('name', 'Events')->with(['posts' => function($query){
            return $query->where('status', 0)->where('featured', '1')->orderBy('id', 'desc')->take(4);
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
        $managers = User::whereRoleIs('country-manager')->where('status', 1)->get();
        return view('about-us', compact('team', 'managers'));
    }

    /**
     * Show the application Inspiration Index Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function inspirationIndex()
    {
        $posts = Category::where('name', 'Inspiration')->with(['posts' => function($query){
            return $query->where('status', 0)->orderBy('id', 'desc')->get();
        }])->first();
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
        $posts = Category::where('name', 'Events')->with(['posts' => function($query){
            return $query->where('status', 0)->orderBy('id', 'desc')->get();
        }])->first();
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

    /**
     * Show the application Coach Show Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function coachShow($alias)
    {
        $coach = User::whereRoleIs('coach')->where('alias', $alias)->first();
        $costs = Cost::where('level_id', $coach->level_id)->whereIn('service_id', $coach->services->pluck('id'))->get();

        if($coach->certification == '')
            $certification = collect([]);
        else
            $certification = collect(explode(';', $coach->certification));

        if($coach->status == 1)
            return view('coaches.show', compact('coach', 'certification', 'costs'));
        else
            return redirect()->route('home');
    }

    /**
     * Show the application Services Index Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function freeCV()
    {
        $services = Service::find([1, 2, 4, 12]);

        if(!Auth::user()) {
            $isAuth = false;
            return view('free-cv', compact('isAuth', 'services'));
        } else {
            $user = User::findOrFail(Auth::user()->id);
            $isAuth = true;

            if($user->profile_completion >= -1) {
                $resume = Resume::where('user_id', Auth::user()->id)->first();

                if($user->free_cv == 2) {
                    $user->free_cv = 3;
                    $user->save();
                }

                $countries = Country::select('id', 'name')->get();

                if(!empty($resume->coach_id)) $coach = User::findOrFail($resume->coach_id);

                return view('free-cv', compact('resume', 'services', 'coach', 'isAuth', 'countries'));
            } else {
                $isAuth = true;
                $isComplete = false;
                $resume = false;

                return view('free-cv', compact('isAuth', 'isComplete', 'services', 'resume'));
            }
        }
    }

    /**
     * Store a newly created CV in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function freeCVStore(Request $request)
    {
        $this->validate($request, [
            'document' => 'required',
            'country' => 'required',
        ]);

        $resume = new Resume();
        $resume->user_id = Auth::user()->id;

        if(!empty($request->document)) {
            $file = $request->file('document')->store('public/freecvs');
            $resume->document = Storage::url($file);
        }

        if($resume->save()) {
            $user = Auth::user();
            $user->free_cv = 1;
            $user->country = $request->country;

            DB::transaction(function () use ($user, $request) {
                if ($request->countries)
                    $user->countries()->sync(explode(',', $request->countries));
                $user->save();
            }, 5);
            
            $user->notify(new FreeCVRequest($user));

            Session::flash('success', 'Your CV has been successfully uploaded!');
            return redirect()->route('free-cv.index');
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while sending your CV.');
            return redirect()->route('free-cv.index');
        }
    }
}
