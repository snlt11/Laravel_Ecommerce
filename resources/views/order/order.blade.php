@extends('layout.base')

@section('title','Orders')

@section('content')
    <h1 class="text-center text-info my-5">Orders</h1>
    <div class="col-md-8 offset-md-2">
        <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Count</th>
                <th>Total</th>
                <th>Items</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{auth()->user()->name}}</td>
                        <td>{{$order->count}}</td>
                        <td>{{$order->total}}</td>
                        <td>
                            <a href="{{route('orderItemById',$order->id)}}" class="btn btn-info btn-sm"><i class="material-icons">visibility</i></a>
                        </td>
                        <td>
                            <form action="{{route('changeOrderStatus',$order->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button class="btn {{ $order->status ? 'btn-success' : 'btn-danger' }} btn-sm">{{ $order->status ? 'On' : 'Off' }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
@endsection
