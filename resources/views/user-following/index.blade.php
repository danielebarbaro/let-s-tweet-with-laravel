@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <ul class="list-group" id="following">
                    <li class="list-group-item list-group-item-lg">
                        <h3>People {{ "@{$user->username}" }} follows</h3>
                    </li>
                    @forelse ($following as $follower)
                        <li class="list-group-item">
                            <a href="{{ route('users.show', ['username' => $follower->username]) }}" class="link-secondary">
                                <strong>{{ '@' . $follower->username }}</strong>
                            </a>
                            <span class="float-right">
                                <form action="{{ route('following.destroy', ['follower' => $follower->username]) }}" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" href="#" class="btn btn-sm btn-danger">Unfollow</button>
                                </form>
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item list-group-item-lg text-center">
                            It looks like {{ "@{$user->username}" }} isn't following anyone yet!
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
