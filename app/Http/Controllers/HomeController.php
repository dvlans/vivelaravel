<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewEmailContact;
use Mail;

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
        return view('home');
    }

    public function message(Request $request){
        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $admins = User::where('admin', true)->get();
        Mail::to($admins)->send(new NewEmailContact($name, $email, $message));

        return back();
    }
}
