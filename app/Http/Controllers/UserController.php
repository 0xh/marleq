<?php

namespace App\Http\Controllers;

use App\Country;
use App\Service;
use App\Specialty;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use Session;
use Illuminate\Support\Facades\Storage;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('manage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create', compact('roles'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if (!empty($request->password)) {
            $password = trim($request->password);
        } else {
            $password = $this->generatePassword();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);

        if($user->save()) {
            $user->syncRoles(explode(',', $request->roles));
            Session::flash('success', 'User has been successfully created');
            return redirect()->route('users.show', $user->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this user.');
            return redirect()->route('users.create');
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
        $user = User::where('id', $id)->with('roles')->first();
        return view('manage.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->with('roles')->first();
        $roles = Role::all();
        $specialties = Specialty::all();
        $services = Service::all();
        $countries = Country::select('id', 'name')->get();

        return view('manage.users.edit', compact('user', 'roles', 'specialties', 'services', 'countries'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->biography = $request->biography;

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

        if($user->save()) {
            DB::transaction(function () use ($user, $request) {
                $user->syncRoles(explode(',', $request->roles));
                $user->specialties()->sync(explode(',', $request->specialties));
                $user->services()->sync(explode(',', $request->services));
                $user->countries()->sync(explode(',', $request->countries));
            }, 5);

            Session::flash('success', 'User has been successfully edited');
            return redirect()->route('users.show', $id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this user.');
            return redirect()->route('users.edit', $id);
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
        User::destroy($id);
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
}
