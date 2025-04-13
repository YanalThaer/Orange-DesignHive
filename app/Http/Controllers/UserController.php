<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all(); // Fetch all users
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete(); // Perform a soft delete
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function deleted(){
        $users = User::onlyTrashed()->get(); // Fetch all soft-deleted users
        return view('admin.users.deleted', compact('users'));
    }

    public function restore(User $user){
        $user->restore(); // Restore the soft-deleted user
        return redirect()->route('users.deleted')->with('success', 'User restored successfully.');
    }

    public function showDeleted(User $user){
        return view('admin.users.showdeleted', compact('user')); // Return the view with the user data
    }
}
