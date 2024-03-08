@extends('layout.base')

@section('title','Create Sub Categories')

@section('content')
    <h1 class="text-center my-5">Create Sub-Categories</h1>
    <div class="col-md-6 offset-md-3">
        <form action="{{route('category.subcategory.store',$category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input name="name" require="required" type="text"/>
            <x-input name="image" require="required" type="file"/>
            <button type="submit" class="btn btn-primary btn-sm float-end">Create</button>
            <a href="{{url()->previous()}}" class="btn btn-warning btn-sm float-end me-2">Cancle</a>

        </form>
    </div>
@endsection
