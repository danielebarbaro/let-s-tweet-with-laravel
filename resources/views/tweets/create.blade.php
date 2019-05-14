<div class="card border-secondary mb-3">
    <div class="card-body">
        <form action="{{ route('tweets.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" name="body" rows="3" placeholder="Hey!"></textarea>

                @if ($errors->has('body'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>
            <div class="text-right">
                <button class="btn btn-primary btn-wide">Tweet</button>
            </div>
        </form>
    </div>
</div>
