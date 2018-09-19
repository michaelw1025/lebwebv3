<?php

namespace App\Http\Controllers;

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
    public function index(Request $request)
    {
        // return view('home');
        if($request->user()->hasRole(['admin'])){
            return redirect()->route('admin.home');
        }elseif($request->user()->hasAnyRole(['hrmanager', 'hruser', 'hrassistant'])){
            return redirect()->route('hr.home');
        }else{
            return redirect()->route('welcome');
        }
    }

    public function userAPI(Request $request)
    {
        return $request->user();
    }
}
