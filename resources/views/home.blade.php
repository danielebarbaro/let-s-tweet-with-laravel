@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @if(!empty($tweets))
                    @include('tweets.create')
                    @foreach ($tweets as $tweet)
                        @include('tweets.show', ['tweet' => $tweet])
                    @endforeach
                @else
                    <h3>There are no Tweets.</h3>
                @endif
            </div>
            <div class="col-md-5">
                @auth
                    @include('partials.user-profile', ['user' => Auth::user()])
                    @include('partials.who-to-follow')
                @endauth
            </div>
        </div>
    </div>
@endsection
