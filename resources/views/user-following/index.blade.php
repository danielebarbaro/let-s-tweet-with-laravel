@extends('layouts.app')

@section('content')
    <ul class="list-group" id="following">
        <li class="list-group-item list-group-item-lg">
            <h3>People {{ "@{$user->username}" }} follows</h3>
        </li>
        @forelse ($following as $follower)
            <li class="list-group-item list-group-item-lg-short flex-justified">
                <div>
                    <a href="{{ route('users.show', ['username' => $follower->username]) }}" class="link-secondary">
                        <strong>{{ '@' . $follower->username }}</strong>
                    </a>
                </div>
                <form action="{{ route('following.destroy', ['follower' => $follower->username]) }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" href="#" class="btn btn-sm btn-danger">Unfollow</button>
                </form>
            </li>
        @empty
            <li class="list-group-item list-group-item-lg text-center">
                It looks like {{ "@{$user->username}" }} isn't following anyone yet!
            </li>
        @endforelse
    </ul>
@endsection

@section('sidebar')
    @include('partials.user-profile', ['user' => $user])
@endsection
