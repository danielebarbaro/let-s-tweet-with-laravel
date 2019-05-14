<div class="card border-secondary mb-3">
    <div class="card-body">
        <form action="{{ route('tweets.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" name="tweet" rows="3" placeholder="Hey!"></textarea>

                @if ($errors->has('tweet'))
                    <p class="help-block">{{ $errors->first('tweet') }}</p>
                @endif
            </div>
            <div class="text-right">
                <button class="btn btn-primary btn-wide">Tweet</button>
            </div>
        </form>
    </div>
</div>
