<?php

namespace App\Http\Controllers\Tweets;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetRequest;

class TweetsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  TweetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TweetRequest $request)
    {
        $this->me()->tweet($request->validated());
        return redirect('/');
    }
}
