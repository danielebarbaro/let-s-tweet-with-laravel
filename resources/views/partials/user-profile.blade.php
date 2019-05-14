<div class="card border-secondary mb-3">
    <div class="card-header text-center">
        <a href="{{ route('users.show', ['username' => $user->username]) }}"
           class="link-secondary">{{ '@' . $user->username }}</a>
    </div>
    <div class="card-body">
        <a href="{{ route('users.show', ['username' => $user->username]) }}" class=" card-link">
            {{ $tweetCount }} {{ Str::plural('Tweet', $tweetCount) }}
        </a>

        <a href="{{ route('user-followers.index', ['username' => $user->username]) }}" class=" card-link">
            {{ $followerCount }} {{ Str::plural('Follower', $followerCount) }}
        </a>

        <a href="{{ route('user-following.index', ['username' => $user->username]) }}" class=" card-link">
            {{ $followingCount }} Following
        </a>
    </div>
</div>
