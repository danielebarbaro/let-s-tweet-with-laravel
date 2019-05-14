<div class="card border-default mb-3">
    <div class="card-body">
        <h5>
            <a href="{{ route('users.show', ['username' => $tweet->user->username]) }}" class="link-secondary">
                <strong>{{ '@' . $tweet->user->username }}</strong>
            </a>
            <small>
                {{ $tweet->created_at->diffForHumans() }}
            </small>
        </h5>
        <div>
            {{ $tweet->body }}
        </div>
    </div>
</div>
