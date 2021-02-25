<?php

namespace App\Http\Controllers\Bloger;

use App\Http\Controllers\Controller;
use App\Mail\PostCreated;
use App\Models\Category;
use App\Models\Hashtag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->get();

        return view('bloger.post.all', compact('posts'));
    }


    public function create()
    {
        $categories = Category::where('status', 1)->get();

        $hashtags = Hashtag::where('status', 1)->get();

        return view('bloger.post.create', compact('categories', 'hashtags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'body' => 'required|string',
            'hashtags' => 'required|array|min:1',
            'files' => 'required|array|min:1',
            'category' => 'required|integer',
            'status' => 'required|integer',

            'files.*' => 'image'
        ]);

        $filenames = [];
        foreach ($request->file('files') as $file){
            $fileName = $file->store('public/blog_files');
            $num = 1;
            $fileName = str_replace('public', '', $fileName, $num);
            $filenames[] = $fileName;
        }

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'files' => json_encode($filenames),
            'user_id' => $request->user()->id,
            'category_id' => $request->category,
            'status' => $request->status
        ]);

        $post->hashtags()->sync($request->hashtags);

        \App\Jobs\PostCreated::dispatch($request->user(), $post->title);

        return redirect(route('post'))->with('success', 'Post created successfuly');


    }

    public function edit($id)
    {
        $posts = Post::findOrFail($id);

        if (Gate::denies('update-post', $posts)) {
           abort(403);
        }

        $categories = Category::all();

        $hashtags = Hashtag::all();

        return view('bloger.post.edit', compact( 'posts', 'hashtags' , 'categories'));

    }

    public function view($id){

        $post = Post::findOrFail($id);

        if (Gate::denies('update-post', $post)) {
            abort(403);
        }


        return view('bloger.post.view', compact('post', ''));

    }
}
