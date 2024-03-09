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

    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $tags = Tag::all();
        return view('product.create', compact('categories', 'subcategories', 'tags'));
        //
    }

    public function store(ProductCreateRequest $request)
    {
        $files = $request->file('images');
        $images = "";

        foreach ($files as $file) {
            $imageName = uniqid() . "_" . $file->getClientOriginalName();
            $images .= $imageName . ",";
            $file->move(public_path() . '/uploads', $imageName);
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

    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $tags = Tag::all();
        $product = Product::find($product->id);
        return view('product.edit', compact('categories', 'subcategories', 'tags', 'product'));
    }

    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'tag_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'description' => 'required'
        ]);

        if ($validated) {
            $product = Product::find($product->id);
            if ($request->hasFile('images')) {

                $files = $request->file('images');
                $images = "";

                foreach ($files as $file) {
                    $imageName = uniqid() . "_" . $file->getClientOriginalName();
                    $images .= $imageName . ",";
                    $file->move(public_path() . '/uploads'.$imageName);
                }
                $product->images = $images;
            }
            $product->category_id = $request->input('category_id');
            $product->subcategory_id = $request->input('subcategory_id');
            $product->tag_id = $request->input('tag_id');
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->colors = $request->input('colors');
            $product->sizes = $request->input('sizes');
            $product->description = $request->input('description');
            $product->update();
            return redirect()->route('products.index');
        } else {
            return redirect()->back()->with('errors', 'Update product Failed');
        }
    }
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
