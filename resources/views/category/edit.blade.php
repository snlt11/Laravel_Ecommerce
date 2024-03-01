@extends('layout.base')

@section('title','Edit Category')

@section('content')
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center my-5">Edit Categories</h1>
        <form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input name="name" require="required" type="text" :value="$category->name" />
            <input type="hidden" name="_method" value="PATCH">
            <p>Current Image =>
                <a href="{{url('/uploads/'.$category->image)}}">{{$category->image}}</a>

            </p>
            <x-input name="image" type="file"/>
            <button type="submit" class="btn btn-primary btn-sm float-end">Update</button>
        </form>
    </div>
@endsection
