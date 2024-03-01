<div class="mb-3">
    <label for="{{$name}}" class="form-label">@php
        echo Str::ucfirst($name)
    @endphp</label>
    <input type="{{$type}}" {{$require ?? ""}} value="{{$value ?? old('$name')}}" class="form-control @if($errors->has($name)) is-invalid @endif" id="{{$name}}" name="{{$name}}" aria-describedby="{{$name}}Help">
  </div>
  @error($name)
      <div id="{{$name}}Help" class="form-text text-danger">{{$errors->first($name)}}</div>
  @enderror
