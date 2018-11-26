<?php

namespace App\Http\Controllers;

use App\Country;
use App\Language;
use App\Level;
use App\Notifications\UserRegistered;
use App\Notifications\FreeCVResults;
use App\Resume;
use App\Service;
use App\Specialty;
use App\Testimonial;
use App\TipType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Role;
use Hash;
use Intervention\Image\Facades\Image;
use Session;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if(!$user->country) return redirect()->route('profile.edit', $user->alias);

        $certification = collect(explode(';', $user->certification));

        return view('user.profile.index', compact('user', 'certification'));
    }

    /**
     * Show the form for creating a new business card.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBusinessCard()
    {
        $user = Auth::user();

        if ($user->level) {
            $title = $user->level->name;
            if ($user->hasRole('country-manager')) $countryManager = 'Country Manager';
            if ($user->country) $countryManager .= ' from ' . $user->country;
        }

        return view('user.profile.business-card', compact('user', 'title', 'countryManager'));
    }

    /**
     * Store a newly created business card in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBusinessCard(Request $request)
    {
        $image = Image::make('images/marleq-business-card-background.jpg');
        $logo = Image::make('images/marleq-logo-color.png');

        if (strlen($request->name) < 10) {
            $name = '';
            $surname = $request->name;
        } else {
            $nameArr = explode(' ', $request->name);

            if (isset($nameArr[0]) && isset($nameArr[1])) {
                $name = $nameArr[0];
                $surname = $nameArr[1];
            } else {
                $name = '';
                $surname = '';
            }
        }

        $countryManager = (isset($request->countrymanager)) ? $request->countrymanager : '';

        $image->insert($logo, 'top-left', 97, 121);

        $image->text(strtoupper($name), 95, 210, function($font) {
            $font->file('fonts/verb-extra-bold.ttf');
            $font->size(60);
            $font->color('#00a7e1');
            $font->align('left');
            $font->valign('top');
        });

        $image->text(strtoupper($surname), 95, 270, function($font) {
            $font->file('fonts/verb-extra-bold.ttf');
            $font->size(60);
            $font->color('#00a7e1');
            $font->align('left');
            $font->valign('top');
        });

        $image->text($request->title, 95, 340, function($font) {
            $font->file('fonts/verb-light.ttf');
            $font->size(28);
            $font->color('#474946');
            $font->align('left');
            $font->valign('top');
        });

        $image->text($countryManager, 95, 380, function($font) {
            $font->file('fonts/verb-light.ttf');
            $font->size(28);
            $font->color('#474946');
            $font->align('left');
            $font->valign('top');
        });

        $image->text($request->phone, 95, 472, function($font) {
            $font->file('fonts/verb-light.ttf');
            $font->size(28);
            $font->color('#474946');
            $font->align('left');
            $font->valign('top');
        });

        $image->text($request->email, 95, 510, function($font) {
            $font->file('fonts/verb-light.ttf');
            $font->size(28);
            $font->color('#474946');
            $font->align('left');
            $font->valign('top');
        });

        $image->text('www.marleq.com', 95, 550, function($font) {
            $font->file('fonts/verb-light.ttf');
            $font->size(28);
            $font->color('#474946');
            $font->align('left');
            $font->valign('top');
        });

        $name = 'business-card.jpg';
        $headers = [
            'Content-Type' => 'image/jpeg',
            'Content-Disposition' => 'attachment; filename='. $name,
        ];

//        return $image->response('jpg');
        return response()->stream(function() use ($image) {
            echo $image->encode('jpg');
        }, 200, $headers);
    }

    /**
     * Show the User Testimonials Index Page with Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function testimonials()
    {
        $user = Auth::user();

        $testimonials = Testimonial::where('user_id', $user->id)->get();

        return view('user.profile.testimonials', compact('user', 'testimonials'));
    }

    /**
     * Store a newly created Testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function testimonialStore(Request $request)
    {
        $this->validate($request, [
            'testimonial_content' => 'required|string'
        ]);

        $testimonial = new Testimonial();
        $testimonial->content = $request->testimonial_content;
        $testimonial->featured = 0;
        $testimonial->user_id = Auth::user()->id;
        $testimonial->reviewed = 0;

        if($testimonial->save()) {
            Session::flash('success', 'Your testimonial has been successfully created');
            return redirect()->route('testimonial.index', $testimonial->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this testimonial.');
            return redirect()->route('testimonial.index');
        }
    }

    /**
     * Show Users Free CV Requests Index Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function freeCVRequests()
    {
        $user = Auth::user();
        if($user->status == 0) return redirect()->route('profile.index', $user->alias);

        $resumes = Resume::where('status', 0)->orWhere('coach_id', $user->id)->orderBy('status', 'asc')->orderBy('created_at', 'asc')->get();

        return view('user.profile.cv-requests', compact('user', 'resumes'));
    }

    /**
     * Show the form for editing the Free CV Request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function freeCVEdit($id)
    {
        $user = Auth::user();
        if($user->status == 0) return redirect()->route('profile.index', $user->alias);

        $resume = Resume::findOrFail($id);
        $tipTypes = TipType::all();

        return view('user.profile.cv-request-edit', compact('user', 'resume', 'tipTypes'));
    }

    /**
     * Update the specified Free CV Request in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function freeCVUpdate(Request $request, $id)
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
            return redirect()->route('cv-requests.index');
        } else {
            return redirect()->route('cv-requests.edit', $resume->id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $alias
     * @return \Illuminate\Http\Response
     */
    public function edit($alias)
    {
//        $user = User::where('alias', $alias)->first();
        $user = Auth::user();
        if(Auth::user()->hasRole('coach|country-manager')) {
            $specialties = Specialty::all();
            $services = Service::all();
            $levels = Level::all();
        } else {
            $specialties = null;
            $services = null;
            $levels = null;
        }
        $countries = Country::select('id', 'name')->get();
        $languages = Language::select('id', 'name')->get();

        if($user->certification == '')
            $certification = collect([]);
        else
            $certification = collect(explode(';', $user->certification));

        return view('user.profile.edit', compact('user', 'specialties', 'services', 'countries', 'languages', 'levels', 'certification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        if($request->alias) {
            $request['alias'] = $this->stringURLSafe($request->alias);
        } else {
            $request['alias'] = $this->stringURLSafe(
                str_replace('.' , '-',substr($request['email'], 0, strpos($request['email'], '@'))) . '-' . str_random(20)
            );
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'alias' => Rule::unique('users')->ignore($id),
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->alias = $request->alias;
        $user->social_network = $request->social_network;
        $user->email = $request->email;
        $user->biography = $request->biography;
        $user->country = $request->country;
        $user->certification = str_replace(',', ';', $request->certification);

        if($request->level == -1)
            $user->level_id = NULL;
        else
            $user->level_id = $request->level;

        // Cropped Image is important, without it the User can't upload a new photo
        if(!empty($request->picture_crop)) {
            // Original Image
            if(!empty($request->picture)) {
                if(Storage::disk('public')->exists(str_replace('/storage/', '', $user->picture))) {
                    Storage::delete(str_replace('/storage/', 'public/', $user->picture));
                }
                $file = $request->file('picture')->store('public/user-pictures');
                $user->picture = Storage::url($file);
            }

            // Cropped Image
            if(Storage::disk('public')->exists(str_replace('/storage/', '', $user->picture_crop))) {
                Storage::delete(str_replace('/storage/', 'public/', $user->picture_crop));
            }

            $base64_str = substr($request->picture_crop, strpos($request->picture_crop, ",") + 1);
            $image = base64_decode($base64_str);
            $imageName = 'user-pictures/'. $user->id . '-' . time() . '.jpg';
            Storage::disk('public')->put($imageName, $image);
            $user->picture_crop = '/storage/' . $imageName;
        }

        if(!empty($request->document)) {
            if(Storage::disk('public')->exists(str_replace('/storage/', '', $user->document))) {
                Storage::delete(str_replace('/storage/', 'public/', $user->document));
            }
            $file = $request->file('document')->store('public/user-documents');
            $user->document = Storage::url($file);
        }

        if ($request->passwordOptions == 'auto') {
            $user->password = Hash::make($this->generatePassword());
        }

        if ($request->passwordOptions == 'manual') {
            $user->password = Hash::make($request->password);
        }

        $user->profile_completion = $this->profileCompletion($request, $user->picture_crop, $user->document, $user->status);

        if($user->save()) {
            DB::transaction(function () use ($user, $request) {
                if(Auth::user()->hasRole('coach|country-manager')) {
                    if ($request->specialties) $user->specialties()->sync(explode(',', $request->specialties));
                    if ($request->services) $user->services()->sync(explode(',', $request->services));
                }
                if($request->countries)
                    $user->countries()->sync(explode(',', $request->countries));
                else
                    $user->countries()->detach();

                if($request->language)
                    $user->languages()->sync(explode(',', $request->language));
                else
                    $user->languages()->detach();
            }, 5);

            if(Auth::user()->hasRole('coach|country-manager')) {
                if ($user->profile_completion >= 5) $user->notify(new UserRegistered($user));
            }

            Session::flash('success', 'Your Profile has been successfully edited');
            return redirect()->route('profile.index');
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating your Profile.');
            return redirect()->route('profile.edit', $user->alias);
        }
    }

    /**
     * Returns Profile Completion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $picture_crop
     * @param  string $document
     * @param  integer $status
     * @return integer
     */
    public function profileCompletion(Request $request, $picture_crop, $document, $status)
    {
        $user = Auth::user();

        if(!$user->hasRole('user')) {
            if(empty($request->biography)) return 0;
            if(empty($request->picture_crop) and empty($picture_crop)) return 1;
        }

        if($user->hasRole('user')) {
            if(empty($request->countries)) return 1;
        }

        if(empty($request->language) or empty($request->countries)) return 2;

        if(!$user->hasRole('user')) {
            if (empty($request->document) and empty($document)) return 3;
        }

        if($user->hasRole('coach|country-manager')) {
            if(empty($request->specialties) or empty($request->services) or empty($request->countries) or $request->level == -1) return 4;
        }

        if($user->hasRole('user')) {
            return 4;
        }

        if($status == 0) return 5;

        return 6;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Generate Password
     */
    public function generatePassword()
    {
        $length = 10;
        $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $string = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $string .= $keyspace[random_int(0, $max)];
        }
        return $string;
    }

    /**
     * This method processes a string and replaces all accented UTF-8 characters by unaccented
     * ASCII-7 "equivalents", whitespaces are replaced by hyphens and the string is lowercase.
     *
     * @param   string  $string    String to process
     *
     * @return  string  Processed string
     */
    function stringURLSafe($string)
    {
        // Remove any '-' from the string since they will be used as concatenaters
        $str = str_replace('-', ' ', $string);

        // Trim white spaces at beginning and end of alias and make lowercase
        $str = trim(strtolower($str));

        // Remove any duplicate whitespace, and ensure all characters are alphanumeric
        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);

        // Trim dashes at beginning and end of alias
        $str = trim($str, '-');

        return $str;
    }
}
