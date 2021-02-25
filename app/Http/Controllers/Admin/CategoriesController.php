<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

//        $categories = Category::all();

        $categories = Category::paginate(2);

        return view('admin.categories.all', compact('categories'));
    }

    /**
     * Return view to create category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Create category
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'status' => 'required'
        ]);


        DB::insert('insert into categories (name, status) values (?, ?)', [$request->name, $request->status]);


//        Category::create([
//            'name' =>  $request->name,
//            'status' => $request->status
//        ]);

        return redirect('/admin/categories')->with('success', 'Category created successfully.');
    }

    /**
     * Edit all categories
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
//        $category = Category::where(['id' => $id])->get();
//        $category = Category::where(['id' => $id])->first();
//        $category = Category::find($id);

        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact( 'category'));
      //todo    get category and return to view
        // check eloquent get by id
    }

    /**
     * Update Categories
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'status' => 'required'
        ]);

        Category::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect('/admin/categories')->with('success', 'Category updated successfully');
    }

    /**
     * Delete Category
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        Category::destroy($id);

        return redirect('/admin/categories')->with('success', 'Category deleted succesfully');
    }
}
