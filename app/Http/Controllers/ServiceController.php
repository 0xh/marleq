<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('id', 'asc')->paginate(15);
        return view('manage.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->alias) {
            $request['alias'] = $this->stringURLSafe($request->alias);
        } else {
            $request['alias'] = $this->stringURLSafe($request->name);
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'alias' => 'unique:services|string|max:255',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->featured = $request->featured;
        $service->description = $request->description;
        $service->alias = $request->alias;

        if(!empty($request->service_image)) {
            $file = $request->file('service_image')->store('public/services');
            $service->image = Storage::url($file);
        }

        if($service->save()) {
            Session::flash('success', 'Service has been successfully created');
            return redirect()->route('services.show', $service->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this service.');
            return redirect()->route('services.create');
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
        $service = Service::findOrFail($id);
        return view('manage.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('manage.services.edit', compact('service'));
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
        if($request->alias) {
            $request['alias'] = $this->stringURLSafe($request->alias);
        } else {
            $request['alias'] = $this->stringURLSafe($request->name);
        }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'alias' => Rule::unique('services')->ignore($id),
        ]);

        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->featured = $request->featured;
        $service->description = $request->description;
        $service->alias = $request->alias;

        if(!empty($request->service_image)) {
            if(Storage::disk('public')->exists(str_replace('/storage/', '', $service->image))) {
                Storage::delete(str_replace('/storage/', 'public/', $service->image));
            }
            $file = $request->file('service_image')->store('public/services');
            $service->image = Storage::url($file);
        }

        if($service->save()) {
            Session::flash('success', 'Service has been successfully updated');
            return redirect()->route('services.show', $service->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this service.');
            return redirect()->route('services.edit', $service->id);
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
        $service = Service::findOrFail($id);

        if(!empty($service->image)) {
            if(Storage::disk('public')->exists(str_replace('/storage/', '', $service->image))) {
                Storage::delete(str_replace('/storage/', 'public/', $service->image));
            }
        }
        Service::destroy($id);
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
