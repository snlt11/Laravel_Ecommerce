@extends('layout.base')

@section('title','Admin Login')

@section('content')
    <h1 class="text-center my-5 text-info">Admin Login</h1>
    <div class="col-md-6 offset-md-3">
        <form method="POST" autocomplete="off">
            @csrf
            <x-input name="phone" type="number" require="required"/>
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
@push('script')
<script>
    let check = localStorage.getItem('rememberMe');
    if(check == 'true') {
        let phone = localStorage.getItem('phone');
        document.querySelector('#phone').value = phone;
        document.querySelector('#rememberMe').checked = check == 'true';
    }
</script>
@endpush

