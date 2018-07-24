<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get all users with roles
        $users = User::with('role')->orderBy('last_name')->get();
        return view('admin.users.users', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get user by id
        $user = User::with('role')->findOrFail($id);
        // Get all roles
        $roles = Role::all();
        return view('admin.users.user-show', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get user by id
        $user = User::with('role')->findOrFail($id);
        // Get all roles
        $roles = Role::all();
        return view('admin.users.user-edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get the user by id
        $user = User::findOrFail($id);
        // Set the user parameters from the request
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        // Save the user
        if($user->save()){
            // If save successful
            if($user->role()->sync([$request->role])){
                // If role sync successful
                \Session::flash('status', 'User edit successful.');
            }else{
                // If role sync unsuccessful
                \Session::flash('error', 'An error occurred while applying the user role.  Please contact support for help.');
            }
        }else{
            // If save unsuccessful
            \Session::flash('error', 'An error occurred while editing the user.  Please contact support for help.');
            return redirect()->back()->withInput();
        }
        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get user by id
        $user = User::findOrFail($id);
        // Delete user and relations
        if($user->role()->sync([])){
            // If role relation deleted
            if($user->delete()){
                // If user deleted
                \Session::flash('status', 'User deleted successfully.');
                return redirect()->route('users.index');
            }else{
                // If user not deleted
                \Session::flash('error', 'An error occurred while deleting the user.  Please contact support for help.');
                return redirect()->route('users.show', ['id' => $user->id]);
            }
        }else{
            // If the role relation was not deleted
            \Session::flash('error', 'An error occurred while removing the user permissions.  Please contact support for help.');
            return redirect()->route('users.show', ['id' => $user->id]);
        }
    }


}
