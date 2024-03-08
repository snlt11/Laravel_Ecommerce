<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $tags = Tag::all();
        return view('product.create', compact('categories', 'subcategories', 'tags'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $files = $request->file('images');
        $images = "";

        foreach ($files as $file) {
            $imageName = uniqid() . "_" . $file->getClientOriginalName();
            $images .= $imageName . ",";
        }
        $images = rtrim($images, ',');

        $product = new Product();
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->tag_id = $request->input('tag_id');
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->images = $images;
        $product->colors = $request->input('colors');
        $product->sizes = $request->input('sizes');
        $product->description = $request->input('description');
        $product->save();
        return redirect()->route('products.index');
    }


    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $tags = Tag::all();
        $product = Product::find($product->id);
        return view('product.edit', compact('categories', 'subcategories', 'tags', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
