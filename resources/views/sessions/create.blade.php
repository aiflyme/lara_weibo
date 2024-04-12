@extends('layouts.default')
@section('title', 'login')

@section('content')
<div class="offset-md-2 col-md-8">
    <div class="card ">
        <div class="card-header">
            <h5>login</h5>
        </div>
        <div class="card-body">
            @include('shared._errors')

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email">email：</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password">password：（<a href="{{ route('password.request') }}">forget password</a>） </label>
                    <input type="password" name="password" class="form-control" >
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">log in</button>
            </form>

            <hr>

            <p>no account？<a href="{{ route('user.create') }}">Register now！</a> </p>
        </div>
    </div>
</div>
@stop
