@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <li class="list-group-item list-group-item-lg">
                    <h3>Home Tweets {{ "@{$user->username}" }}</h3>
                </li>

                @forelse ($tweets as $tweet)
                    <li class="list-group-item list-group-item-lg">
                        @include('tweets.show', ['tweet' => $tweet])
                    </li>
                @empty
                    <li class="list-group-item list-group-item-lg text-center">
                        It looks like {{ "@{$user->username}" }} hasn't tweeted yet!
                    </li>
                @endforelse
            </div>
            <div class="col-md-5">
                @auth
                    @include('partials.user-profile', ['user' => $user])
                    @include('partials.who-to-follow')
                @endauth
            </div>
        </div>
    </div>
@endsection
