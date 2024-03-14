@extends('layout.base')

@section('title','Order Items')

@section('content')
    <h1 class="text-center text-info my-5">Order Items</h1>
    <div class="col-md-8 offset-md-2">
        <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Images</th>
                <th>Color</th>
                <th>Size</th>
                <th>Count</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>
                            @php
                                $images = explode("\n", $item->images);
                            @endphp
                            @foreach ($images as $image)
                                <img src="{{url('/uploads/'.$image)}}" alt="Image" width="50" height="50">
                            @endforeach
                        </td>
                        <td>{{$item->color}}</td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->count}}</td>
                        <td>{{$item->price * $item->count}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
