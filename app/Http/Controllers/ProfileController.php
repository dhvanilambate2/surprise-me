<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function passwordUpdate(Request $request)
     {

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|different:old_password',
            'old_password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         $user = Auth::user();
        //  dd($user);
         if (Hash::check($request->old_password, $user->password)) {
             // Old password matches, update the new password
             $user->update([
                 'password' => Hash::make($request->new_password),
             ]);

             return redirect('admin/profile/edit')->with('success', 'Password changed successfully.');
         }

         return redirect('admin/profile/edit')->with('error', 'Old password is incorrect.');
     }
}
