<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $users = User::where('type', '0')->get();
        foreach ($users as $user) {
            $user->roles = $user->roles()->pluck('name')->implode(', ');
        }
        return view('backend.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        
        $roles = Role::pluck('name','name')->all();

        // dd($roles);
        return view('backend.user.create',  ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255', // Example validation for the 'name' field
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'roles' => 'required',
        ]);
    
      
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        // dd($user)
        
        // If validation passes, create the user or perform the necessary actions
        // For now, let's just print a success message
        return redirect('admin/users')->with('success', 'The new User has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRoles = $users->roles->pluck('name','name')->all();
        return view('backend.user.edit', compact('users','roles','userRoles'));

        
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
    
        $user->assignRole($request->input('roles'));
    

        return redirect()->route('users.index')->with('success', 'The User has been Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->route('users.index')->with('success', 'The User has been deleted successfully.');        
    }
}
