<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Post;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Post::where('status', 1);

        if($request->category){
            $query = $query->where('category_id',  $request->category);
        }

        $query = $query->where('title', 'LIKE', '%' . $request->search . '%' );

        $posts = $query->paginate(1);

        $categories = Category::where('status', 1)->get();

        $activeCategory = $request->category;

//        dd($posts);

        return view('posts', compact('posts', 'categories', 'activeCategory'));
    }



}
