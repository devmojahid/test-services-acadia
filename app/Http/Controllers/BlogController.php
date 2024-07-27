<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blog = Blog::create($request->all());

        if ($request->hasFile('thumbnail')) {
            upload_file($request->file('thumbnail'), 'blogs', 'uploads', $blog, 'thumbnail');
        }

        session()->flash('success', 'Blog created successfully');
        return redirect()->back()->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     */

    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $blog = Blog::find($request->id);
        session()->flash('success', 'Blog deleted successfully');
        return redirect()->back()->with('success', 'Blog deleted successfully');
    }
}
