<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admins = Admin::whereNull('deleted_at')->get(); // Exclude soft-deleted records
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(Auth::guard('admin')->user());
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'role' => 'required|string',
            'password' => 'required|string|min:6', // Add validation for password
        ]);
    
        Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')), // Hash the password
        ]);
    
        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'role' => 'required|string',
        ]);
    
        $admin->update($request->all());
        // dd($request->all());
        // $admin->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
        $admin->delete(); // Perform a soft delete
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }

    public function dashboard(){

        // Temporarily bypass authentication check
        $admin = Auth::guard('admin')->user();
        // $admin = Auth::guard('admin')->user();
        // dd($admin);
        return view('admin.dashboard', compact('admin'));
    }

    public function deleted()
    {
        $admins = Admin::onlyTrashed()->get(); // Fetch all soft-deleted admins
        return view('admin.admins.deleted', compact('admins'));
    }

    public function restore(Admin $admin)
    {
        $admin->restore(); // Restore the soft-deleted admin
        return redirect()->route('admins.deleted')->with('success', 'Admin restored successfully.');
    }

    public function showDeleted(Admin $admin)
    {
        return view('admin.admins.showdeleted', compact('admin')); // Return the view with the admin data
    }
}
