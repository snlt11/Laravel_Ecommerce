@extends('layout.base')

@section('title','Admin Login')

@section('content')
    <h1 class="text-center my-5 text-info">Admin Login</h1>
    <div class="col-md-6 offset-md-3">
        <form method="POST">
            @csrf
            <x-input name="phone" type="number" value="09100200300" require="required"/>
            <x-input name="password" type="password"/>

            <div class="col-md-3 mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>

            <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

    </div>
@endsection
