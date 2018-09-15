@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h4>User names stored in db</h4>
    <ul>
        <form method="post" action="/bla">
            <div>
            <input type="email" name="email" id="email">
            <input class="waves-effect waves-light btn" type="submit" value="enter">
            </div>
            {{-- add CSRF protection https://stackoverflow.{-m/a/31683058 --}}
        </form>
        @foreach ($users as $user)
            <li>{{ $user->username }}</li>
        @endforeach
    </ul>
@endsection()