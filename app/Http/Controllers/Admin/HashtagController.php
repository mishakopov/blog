<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hashtag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HashtagController extends Controller
{

    /**
     * Hashtags Table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $hashtags = Hashtag::paginate(2);
        return view('admin/hashtags/all', compact('hashtags'));


    }


    public function create()
    {
        return view('admin.hashtags.create');
    }



    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string',
            'status' => 'required'
        ]);

        Hashtag::create([
          'name' => $request->name,
          'status' => $request->status
        ]);

        return redirect(route('hashtags'))->with('success', 'Hashtag created succesfully');
    }

    public function edit($id)
    {

        $hashtag = Hashtag::findOrFail($id);

        return view('admin.hashtags.edit', compact( 'hashtag'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'status' => 'required'
        ]);

        Hashtag::where('id', $id)->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect('/admin/hashtags')->with('success', 'Hashtag updated successfully');
    }


    public function delete($id)
    {
        Hashtag::destroy($id);

        return redirect('/admin/hashtags')->with('success', 'Hashtag deleted succesfully');
    }

}
