<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use Storage;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->paginate(15);
        return view('manage.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereRoleIs(['administrator'])->get();
        $userId = -1;
        $categories = Category::all();
        $tags = Tag::all();

        return view('manage.posts.create', compact('users', 'userId', 'categories', 'tags'));
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
            $request['alias'] = $this->stringURLSafe($request->title);
        }

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'alias' => 'unique:posts|string|max:255',
            'category' => 'required|integer|min:0',
            'status' => 'required|integer|min:0',
            'featured' => 'required|integer|min:0',
            'access' => 'required|integer|min:0',
            'user' => 'required|integer|min:1',
            'article_content' => 'required'
        ]);

//        dd($request);
        $post = new Post();

        $post->title = $request->title;
        $post->alias = $request->alias;
        $post->category_id = $request->category;
        $post->user_id = $request->user;
        $post->access = $request->access;
        $post->status = $request->status;
        $post->featured = $request->featured;
        $post->content = $request->article_content;

        if(!empty($request->intro_image)) {
            $file = $request->file('intro_image')->store('public/posts');
            $post->intro_image = Storage::url($file);
        }
        if(!empty($request->full_image)) {
            $file = $request->file('full_image')->store('public/posts');
            $post->full_image = Storage::url($file);
        }

        if($post->save()) {
            if($request->post_tags) {
                DB::transaction(function () use ($post, $request) {
                    $post->tags()->sync(explode(',', $request->post_tags));
                }, 5);
            }

            Session::flash('success', 'Post has been successfully created');
            return redirect()->route('posts.show', $post->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while creating this post.');
            return redirect()->route('posts.create');
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
        $post = Post::findOrFail($id);
        return view('manage.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::whereRoleIs(['administrator'])->get();
        $categories = Category::all();
        $tags = Tag::all();

        if(!$userId = $post->user_id) $userId = '-1';

        return view('manage.posts.edit', compact('post', 'users', 'userId', 'categories', 'tags'));
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
            $request['alias'] = $this->stringURLSafe($request->title);
        }

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'alias' => Rule::unique('posts')->ignore($id),
            'category' => 'required|integer|min:0',
            'status' => 'required|integer|min:0',
            'featured' => 'required|integer|min:0',
            'access' => 'required|integer|min:0',
            'user' => 'required|integer|min:1',
            'article_content' => 'required'
        ]);

//        dd($request);
        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->alias = $request->alias;
        $post->category_id = $request->category;
        $post->user_id = $request->user;
        $post->access = $request->access;
        $post->status = $request->status;
        $post->featured = $request->featured;
        $post->content = $request->article_content;

        if(!empty($request->intro_image)) {
            if(Storage::disk('public')->exists(str_replace('/storage/', '', $post->intro_image))) {
                Storage::delete(str_replace('/storage/', 'public/', $post->intro_image));
            }
            $file = $request->file('intro_image')->store('public/posts');
            $post->intro_image = Storage::url($file);
        }
        if(!empty($request->full_image)) {
            if(Storage::disk('public')->exists(str_replace('/storage/', '', $post->full_image))) {
                Storage::delete(str_replace('/storage/', 'public/', $post->full_image));
            }
            $file = $request->file('full_image')->store('public/posts');
            $post->full_image = Storage::url($file);
        }

        if($post->save()) {
            if($request->post_tags) {
                DB::transaction(function () use ($post, $request) {
                    $post->tags()->sync(explode(',', $request->post_tags));
                }, 5);
            }

            Session::flash('success', 'Post has been successfully updated');
            return redirect()->route('posts.show', $post->id);
        } else {
            Session::flash('danger', 'Sorry, a problem occurred while updating this post.');
            return redirect()->route('posts.edit', $post->id);
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
        Post::destroy($id);
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
