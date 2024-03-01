@extends('layout.base')

@section('title','Admin Login')

@section('content')
        <h1 class="text-center my-5 text-info">Admin Login</h1>
    <div class="col-md-6 offset-md-3">
        <form method="POST" >
            <div class="mb-3">
              <label for="phone" class="form-label">Enter Your Phone Number</label>
              <input type="number" class="form-control is-invalid" id="phone" name="phone" aria-describedby="phoneHelp">
              <div id="phoneHelp" class="form-text text-danger">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Enter Your Password</label>
              <input type="Password" class="form-control is-invalid" id="password" name="password" aria-describedby="passwordHelp">
              <div id="passwordHelp" class="form-text text-danger">We'll never share your password with anyone else.</div>
            </div>
                    <div class="col-md-3 mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember Me</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
          </form>

    </div>
@endsection
