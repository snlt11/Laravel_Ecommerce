@extends('layout.base')

@section('title','All Categories')

@section('content')
    <h1 class="text-center my-5">All Categories</h1>
    <div class="col-md-8 offset-md-2">
        <a href="{{route('admin.home')}}" class="btn btn-primary btn-sm">Back <i class="material-icons">arrow_back_ios</i> </a>
        <a href="{{route('category.create')}}" class="btn btn-primary btn-sm">Create <i class="material-icons">add</i> </a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Child</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td><img src="{{url('/uploads/'.$category->image)}}" alt="" width="40" height="40"></td>
                        <td>
                            <a href="{{route('category.subcategory.index',$category->id)}}"><i class="material-icons">visibility</i></a>
                        </td>
                        <td>
                            <a href="{{route('category.edit',$category->id)}}" class="btn btn-warning btn-sm">
                                <i class="material-icons">edit</i>
                            </a>
                            <x-button :action="route('category.destroy', $category->id)" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
