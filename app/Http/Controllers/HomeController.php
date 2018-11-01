<?php

namespace App\Http\Controllers;

use App\Client;
use App\Email;
use Illuminate\Http\Request;

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
        $clientes = Client::all();
        $emails = Email::all();
        return view('home', compact('clientes','emails'));
    }
}
