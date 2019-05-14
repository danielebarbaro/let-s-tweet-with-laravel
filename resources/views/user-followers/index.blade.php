@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-lg">
                        <h3>People following {{ "@{$user->username}" }}</h3>
                    </li>
                    @forelse ($followers as $follower)
                        <li class="list-group-item list-group-item-lg">
                            <a href="{{ route('users.show', ['username' => $follower->username]) }}" class="link-secondary">
                                <strong>{{ '@' . $follower->username }}</strong>
                            </a>
                        </li>
                    @empty
                        <li class="list-group-item list-group-item-lg text-center">
                            It looks like {{ "@{$user->username}" }} doesn't have any followers yet!
                        </li>
                    @endforelse
                </ul>
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


