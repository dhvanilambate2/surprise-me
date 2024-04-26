<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $users = User::find($id); 
        return view('backend.profile.index', compact('users'));
    }

    public function edit()
    {
     
        $id = Auth::id();
        $users = User::find($id);


        if (!$users) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
        return view('backend.profile.edit', compact('users'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|string|max:15',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->route('users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
    
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
    
    
        $user->save();
    
        // Redirect with a success message
        return redirect('admin/profile')->with('success', 'User Updated Successfully');
    }
}
