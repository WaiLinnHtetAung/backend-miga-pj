<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $fileName = uniqid().$request->file('photo')->getClientOriginalName();
        $request->file('photo')->storeAs('public/photos', $fileName);

        Blog::create([
            'title' => $request->title,
            'date'  => $request->date,
            'photo' => $fileName,
            'body'  => $request->body,
        ]);

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $fileName = Blog::findOrFail($id)->photo;
        if($request->hasFile('photo')) {
            if($fileName) {
                Storage::disk('public')->delete('photos/'.$fileName);
            }

            $newFileName = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public/photos', $newFileName);
        }
        Blog::findOrFail($id)->update([
            'date'  => $request->date,
            'title' => $request->title,
            'body'  => $request->body,
            'photo' => $request->file('photo') ? $newFileName : $fileName,
        ]);

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete photo
        Storage::disk('public')->delete('photos/'.Blog::findOrFail($id)->photo);
        Blog::findOrFail($id)->delete();

        return redirect()->route('admin.blogs.index');
    }
}
