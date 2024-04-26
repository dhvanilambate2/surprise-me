<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('backend.roles.create', compact('permissions'));
    }

   public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|unique:roles|max:255',
            'permissions' => 'array', // Assuming an array of permission IDs is submitted
        ]);
    
        // Create a new role
        $role = Role::create(['name' => $request->input('name')]);
        
        // Attach permissions to the role
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            
            // Fetch permission IDs based on permission names
            $permissionIds = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
            
            // Attach the selected permissions to the role
            $role->permissions()->attach($permissionIds);
        dd($role->permissions()->attach($permissionIds));
        }
        

    // Attach the role to the authenticated user (replace this with your user fetching logic)
    auth()->user()->roles()->attach($role->id);
        
        
        return redirect()->route('roles.index')->with('success', 'The new Role has been created successfully.');
    }



    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('backend.roles.edit', compact('role','permissions'));
    }

   public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array', // Assuming an array of permission IDs is submitted
        ]);
    
        $role->update(['name' => $request->input('name')]);
    
        // Sync permissions for the role
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
    
            // Sync role and permissions for the authenticated user
            auth()->user()->roles()->sync([$role->id => ['user_id' => auth()->id()]]);
    
            // Sync the selected permissions
            $role->permissions()->sync($permissions);
        }
    
        return redirect()->route('roles.index')->with('success', 'The Role has been Updated successfully..');
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'The Role has been Deleted successfully.');
    }
}
