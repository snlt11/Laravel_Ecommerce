@extends('layout.base')

@section('title','Admin Home Page')

@section('content')
    @if (session()->has('info'))
        @if (session()->get('info') === 'on')
            @php
                $phone = auth()->user()->phone;
            @endphp
            <script>
                let phone = "{{$phone}}";
                localStorage.setItem('rememberMe', true);
                localStorage.setItem('phone', phone);
            </script>
        @else
            <script>
                localStorage.setItem('rememberMe', false);
                localStorage.removeItem('phone');
            </script>
        @endif
    @endif
    <h1>Admin Home Page</h1>
@endsection



