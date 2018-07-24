<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests\StoreRole;
use App\User;

class RoleController extends Controller
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
        // Get all roles
        $roles = Role::all();
        return view('admin.roles.roles', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        return view('admin.roles.role-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Create a new role instance
        $role = new Role();
        // Set the role paramaters from the request
        $role->description = $request->description;
        $role->name = $request->name;
        // Save the role
        if($role->save()){
            // If the save was successful
            \Session::flash('status', 'Role created successfully.');
            return redirect()->route('roles.show', ['id' => $role->id]);
        }else{
            // If the save was unsuccessful
            \Session::flash('error', 'An error occurred while creating the role.  Please contact support for help.');
            return redirect()->back()->withInput();
        }
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
        // Get role
        $role = Role::findOrFail($id);
        return view('admin.roles.role-show', [
            'role' => $role
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
        // Get role
        $role = Role::findOrFail($id);
        return view('admin.roles.role-edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRole $request, $id)
    {
        //Check if user is authorized to access this page
        $request->user()->authorizeRoles(['admin']);
        // Get role to update
        $role = Role::findOrFail($id);
        // Set role parameters from request
        $role->description = $request->description;
        $role->name = $request->name;
        // Save role
        if($role->save()) {
            // If save was successful
            \Session::flash('status', 'Role edit successful.');
            return redirect()->route('roles.show', ['id' => $role->id]);
        }else {
            // If save was unsuccessful
            \Session::flash('error', 'An error occurred while editing the role.  Please contact support for help.');
            return redirect()->back()->withInput();
        }
        
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
        // Get the role to delete
        $role = Role::findOrFail($id);
        // Check if the role is the user role and prevent deleting
        if($role->name === 'user') {
            \Session::flash('error', 'Cannot delete the general user role.');
            return redirect()->back();
        }else {
            // Get all users who have this role
            $users = User::whereHas('role', function ($q) use ($role) {
                $q->where('role_id', $role->id);
            })->get();
            // Get the general user role
            $generalUserRole = Role::where('name', 'user')->first();
            // Set each user to the general user role before deleting the current role
            $users->each(function($user, $key) use($generalUserRole) {
                $user->role()->sync([$generalUserRole->id]);
            });
            // Delete the role
            if($role->delete()) {
                // If role deleted
                \Session::flash('status', 'Role deleted successfully.');
                return redirect()->route('roles.index');
            }else {
                // If role not deleted
                \Session::flash('error', 'An error occurred while removing the role.  Please contact support for help.');
                return redirect()->route('roles.show', ['id' => $role->id]);
            }
            
        }
    }
}
