@extends('layout.base')

@section('title','All Products')

@section('content')
    <h1 class="text-center my-5">All Product</h1>
    <a href="{{route('products.create')}}" class="btn btn-primary btn-sm">Create <i class="material-icons">add</i></a>

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Colors</th>
                    <th>Sizes</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->images}}</td>
                        <td>{{$product->colors}}</td>
                        <td>{{$product->sizes}}</td>
                        <td>{{$product->price}}</td>
                        <td>
                            @php
                                echo Str::substr($product->description, 0, 10)
                            @endphp
                        </td>
                        <td>
                            <a href="{{route('products.edit',$product->id)}}" class="btn btn-warning"><i class="material-icons">edit</i></a>
                            <a href="{{route('products.destroy',$product->id)}}" class="btn btn-danger"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection


