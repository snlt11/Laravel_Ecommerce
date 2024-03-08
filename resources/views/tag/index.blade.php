@extends('layout.base')

@section('title','All Tags')

@section('content')
    <h1 class="text-center my-5">All Tags</h1>
    <div class="col-md-8 offset-md-2">
        <a href="{{route('admin.home')}}" class="btn btn-primary btn-sm">Back <i class="material-icons">arrow_back_ios</i> </a>
        <a href="{{route('tags.create')}}" class="btn btn-primary btn-sm">Create <i class="material-icons">add</i> </a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{$tag->id}}</th>
                        <td>{{$tag->name}}</td>
                        <td><img src="{{url('/uploads/'.$tag->image)}}" alt="" width="40" height="40"></td>
                        <td>
                            <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-warning btn-sm">
                                <i class="material-icons">edit</i>
                            </a>
                            <x-button :action="route('tags.destroy', $tag->id)" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
