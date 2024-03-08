@extends('layout.base')

@section('title','Edit Tag')

@section('content')
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center my-5">Edit Tag</h1>
        <form action="{{route('tags.update',$tag->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input name="name" require="required" type="text" :value="$tag->name" />
            <input type="hidden" name="_method" value="PATCH">
            <p>Current Image =>
                <a href="{{url('/uploads/'.$tag->image)}}">{{$tag->image}}</a>

            </p>
            <x-input name="image" type="file"/>
            <button type="submit" class="btn btn-primary btn-sm float-end">Update</button>
        </form>
    </div>
@endsection
