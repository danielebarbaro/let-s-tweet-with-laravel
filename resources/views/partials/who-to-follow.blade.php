<div class="card border-secondary mb-3">
    <div class="card-header text-center">
        Who follow
    </div>

    <div class="card-body">
        <ul class="list-group">
            @forelse ($users as $user)
                <li class="list-group-item">
                    <a href="{{ route('users.show', ['username' => $user->username]) }}" class="link-secondary">
                        <strong>{{ '@' . $user->username }}</strong>
                    </a>
                    <span class="float-right">
                        <form action="{{ route('following.store') }}" method="POST">
                            {!! csrf_field() !!}
                            <input type="hidden" name="username" value="{{ $user->username }}">
                            <button type="submit" href="#" class="btn btn-sm btn-light">Follow</button>
                        </form>
                    </span>
                </li>
            @empty
                <li class="list-group-item text-center">
                    Dude, you are alone.
                </li>
            @endforelse
        </ul>
    </div>
</div>
