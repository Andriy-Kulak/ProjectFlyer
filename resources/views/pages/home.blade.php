@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>Project Flyer</h1>
        <p>
            This is a template showcasing the optional theme stylesheet included in Bootstrap.
            Use it as a starting point to create something more unique by building on or modifying it.
        </p>

        <!-- Sign-up / Log in... $signedIn = Auth::check() !-->

            <a href="/auth/login" class="btn btn-primary">Log In</a>
        @if($signedIn)

            <a href="/flyers/create" class="btn btn-primary">Create a flyer</a>
        @else
            <a href="/auth/register" class="btn btn-primary">Sign Up!</a>
        @endif

    </div>

@stop