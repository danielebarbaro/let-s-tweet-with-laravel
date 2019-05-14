<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $following_ids = $this->me()->following()->pluck('following_id')->push($this->me()->id);
        $tweets = Tweet::whereIn('user_id', $following_ids)->limit(20)->get();

        return view('home', compact('tweets'));
    }
}
