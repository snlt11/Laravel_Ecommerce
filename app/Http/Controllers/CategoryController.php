<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $file = $request->file('image');
        $imageName = uniqid() . "_" . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads', $imageName);

        $category = new Category();
        $category->name = $request->input('name');
        $category->image = $imageName;

        if ($category->save()) {
            return redirect()->route('category.index');
        } else {
            return redirect()->back()->with('error', 'Passwords do not match');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $category = Category::find($category->id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        if ($validate) {
            $category = Category::find($category->id);
            $category->name = $request->input('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . "_" . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads', $imageName);
                $category->image = $imageName;
            }
            if ($category->update()) {
                return redirect()->route('category.index');
            } else {
                return redirect()->back()->with('error', 'Update Category Error');
            }
        }
    }

    public function destroy(Category $category)
    {
        $category = Category::find($category->id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
