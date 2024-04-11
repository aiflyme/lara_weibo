@extends('layouts.default')
@section('title', '更新个人资料')

@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card ">
            <div class="card-header">
                <h5>更新个人资料</h5>
            </div>
            <div class="card-body">

                @include('shared._errors')

                <div class="gravatar_edit">
                    <a href="http://gravatar.com/emails" target="_blank">
                        <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar"/>
                    </a>
                </div>

                <form method="POST" action="{{ route('user.update', $user->id )}}">
                    @method('PATCH')
                    @csrf

                    <div class="mb-3">
                        <label for="name">name：</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email">email：</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="password">password：</label>
                        <input type="password" name="password" class="form-control" >
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation">confirm password：</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@stop
