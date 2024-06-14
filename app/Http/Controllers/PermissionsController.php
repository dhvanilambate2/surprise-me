<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionsController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

        public function index()
    {
        $permissions = Permission::all();
        return view('backend.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('backend.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        Permission::create($request->all() + ['guard_name' => 'web']);

        return redirect()->route('permissions.index')->with('success', 'The new Permission has been created successfully.');
    }

    public function edit(Permission $permission)
    {
        return view('backend.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($request->all() + ['guard_name' => 'web']);

        return redirect()->route('permissions.index')->with('success', 'The Permission has been Updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'The Permission has been Deleted successfully..');
    }
}
