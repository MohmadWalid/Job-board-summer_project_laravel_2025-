<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Get the 'role' filter from the request
        $roleFilter = $request->query('role');

        // Start building the query
        $query = User::query();

        // 2. Conditionally filter the query based on the role
        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        // Conditionally apply the onlyTrashed() scope if 'archived' is 'true'
        if ($request->input('archived') == 'true') {
            $query->onlyTrashed();
        }

        // Paginate the results with 10 items per page and 1 link on each side
        $users = $query->paginate(10)->onEachSide(1)->withQueryString();

        // Pass to view
        return view('user.index', compact('users'));
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
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $user = User::findOrFail($id);

        // Update user (name and/or password only - email is not editable)
        $userData = [];

        if (isset($validated['name']))
            $userData['name'] = $validated['name'];


        if (!empty($validated['password']))
            $userData['password'] = Hash::make($validated['password']);


        // Only update if there's data to update
        if (!empty($userData))
            $user->update($userData);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User archived successfully!');
    }

    public function restore(string $id)
    {
        $user = user::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index', ['archived' => 'true'])->with('success', 'User restored successfully!');
    }
}
