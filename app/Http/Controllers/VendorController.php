<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Arr;


class VendorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:vendors-list|vendors-create|vendors-edit|vendors-delete', ['only' => ['index','store']]);
         $this->middleware('permission:vendors-create', ['only' => ['create','store']]);
         $this->middleware('permission:vendors-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vendors-delete', ['only' => ['destroy']]);
    }

    public function index()
    {   
        // $users = User::where('type', '0')->get();
        $users = User::with('roles')->get();
        $vendors = [];
        
        foreach($users as $user)
        {
            foreach($user->roles as $role)
            {
                if ($role->name == "vendor")
                {
                    $vendors[] = $user;
                }
            }
        }
        foreach ($vendors as $user) {
            $user->roles = $user->roles()->pluck('name')->implode(', ');
        }
        return view('backend.vendor.index', ['users' => $vendors]);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('backend.vendor.create',  ['roles' => $roles]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255', // Example validation for the 'name' field
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);
    
      
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole('vendor');
    
        // dd($user)
        
        // If validation passes, create the user or perform the necessary actions
        // For now, let's just print a success message
        return redirect('admin/vendors')->with('success', 'The new User has been added successfully.');
    }

    public function edit(string $id)
    {
        $users = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRoles = $users->roles->pluck('name','name')->all();
        return view('backend.vendor.edit', compact('users','roles','userRoles'));

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|string|max:15',
            'password' => 'nullable|string|min:8',
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        $user->roles()->detach();
    
        $user->assignRole('vendor');
    

        return redirect()->route('vendors.index')->with('success', 'The User has been Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->route('vendors.index')->with('success', 'The User has been deleted successfully.');        
    }
}
