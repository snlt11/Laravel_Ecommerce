@extends('layout.base')

@section('title','Create Category')

@section('content')
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center my-5">Create Categories</h1>
        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input name="name" require="required" type="text"/>
            <x-input name="image" require="required" type="file"/>
            <button type="submit" class="btn btn-primary btn-sm float-end">Create</button>
        </form>
    </div>
@endsection
