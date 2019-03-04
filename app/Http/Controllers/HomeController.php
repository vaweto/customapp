<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\UserWasBanned;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user()->name;
        $tasks = DB::table('tasks')->latest()->get();
        event(new UserWasBanned(\Auth::user()));
        return view('home',[
            'name' => $user,
            'tasks' => $tasks
        ]);
    }
}
