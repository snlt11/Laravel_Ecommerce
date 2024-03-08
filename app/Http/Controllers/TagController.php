<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
        $imageName = uniqid() . "_" . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads', $imageName);

        $tags = new Tag();
        $tags->name = $request->input('name');
        $tags->image = $imageName;

        if ($tags->save()) {
            return redirect()->route('tags.index');
        } else {
            return redirect()->back()->with('error', 'Tags insert failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $tag = Tag::find($tag->id);
        return view('tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        if ($validate) {
            $tag = Tag::find($tag->id);
            $tag->name = $request->input('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . "_" . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads', $imageName);
                $tag->image = $imageName;
            }
            if ($tag->update()) {
                return redirect()->route('tags.index');
            } else {
                return redirect()->back()->with('error', 'Update tag Error');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag = Tag::find($tag->id);
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
