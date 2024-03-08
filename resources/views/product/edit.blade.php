@extends('layout.base')

@section('title','Create Product')

@section('content')
    <h1 class="text-center my-2">Create Product</h1>
    <div class="col-md-8 offset-md-2">
        <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-input name='name' type='text' :value="$product->name" />
                </div>
                <div class="col-md-6">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" name="category_id" id="category_id"
                    onchange="categoryChange(event)">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if ($category->id == $product->category_id) selected @endif >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="subcategory" class="form-label">SubCategory</label>
                    <select class="form-select" name="subcategory_id" id="subcategory_id">

                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tag_id" class="form-label">Tag</label>
                    <select class="form-select" name="tag_id" id="tag_id">
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}" @if($tag->id == $product->tag_id) selected @endif>{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <x-input name='price' type='number' :value="$product->price"/>
                </div>
                <div class="col-md-6">
                    <x-input name='colors' type='text' note="Colors(Please Write With Comma)" :value="$product->colors" />
                </div>
                <div class="col-md-6">
                    <x-input name='sizes' type='text' :value="$product->sizes" />
                </div>
                <div class="col-md-6">
                    <x-input name='images[]' type='file' multi="multiple" />
                    <p>Current Image =><a href="#">{{$product->images}}</a></p>
                </div>
                <div class="col-md-12">
                    <x-textarea name='description' type='text' :value="$product->description" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm float-end">Create</button>

        </form>
    </div>
@endsection

@push('script')
    <script>
        let categories = "{{$categories}}";
        categories = categories.replace(/&quot;/g,"\"");
        categories = JSON.parse(categories);

        let subcategories = "{{$subcategories}}";
        subcategories = subcategories.replace(/&quot;/g,"\"");
        subcategories = JSON.parse(subcategories);

        let categoryChange = (e) => {
            let categoryId = e.target.value;
            filterSubCategory(categoryId);
        }

        let filterSubCategory = (id) => {
            let subcategory = subcategories.filter((s) => s.category_id == id);
            let string = "";
            for(let subcategoryValue of subcategory){
                string += ` <option value="${subcategoryValue.id}">${subcategoryValue.name}</option>`;
            }
            document.querySelector('#subcategory_id').innerHTML = string;
        }
        let selectedCategoryId = "{{$product->category_id}}";
        filterSubCategory(selectedCategoryId);

    </script>
@endpush
