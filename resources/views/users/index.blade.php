@extends('layouts.default')
@section('title', 'All user')

@section('content')
    <div class="offset-md-2 col-md-8">
        <h2 class="mb-4 text-center">All user</h2>
        <div class="list-group list-group-flush">
            @foreach ($users as $user)
                @include('users._user')
            @endforeach
        </div>
        <div class="mt-3">
            {!! $users->render() !!}
        </div>
    </div>

@stop
