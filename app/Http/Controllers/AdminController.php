<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use app\Role;

class AdminController extends Controller
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

    public function index(Request $request) {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        return view('admin.index');
    }

    public function users(Request $request, User $user)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get all users with roles
        $users = $user->with('role')->orderBy('last_name')->get();
        return view('admin.users',[
            'users' => $users
        ]);
    }

    public function roles(Request $request, Role $role)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        return view('admin.roles');
    }
}
