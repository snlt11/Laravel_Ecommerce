<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $categories = Category::find($id)->load('subcategory');
        return view('sub-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $category = Category::find($id);
        return view('sub-category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $file = $request->file('image');
        $imageName = uniqid() . "_" . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/' , $imageName);

        $category = new SubCategory();
        $category->name = $request->input('name');
        $category->category_id = $id;
        $category->image = $imageName;

        if ($category->save()) {
            return redirect()->route('category.subcategory.index', $id);
        } else {
            return redirect()->back()->with('error', 'SubCategory Insert Error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory, $id)
    {
        $category = SubCategory::find($id);
        return view('sub-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        if ($validate) {
            $category = SubCategory::find($id);
            $category->name = $request->input('name');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = uniqid() . "_" . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/' , $imageName);
                $category->image = $imageName;
            }
            if ($category->update()) {
                return redirect()->route('category.subcategory.index', $category->category_id);
            } else {
                return redirect()->back()->with('error', 'Update Sub-Category Error');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory, $id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        return redirect()->route('category.subcategory.index', $subCategory->category_id);
    }
}
