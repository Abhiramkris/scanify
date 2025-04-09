<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $admins = User::where('role', 'admin')->get();
        return view('admin.index', compact('admins'));
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
    }

    public function toggleStatus(User $admin)
    {
        $this->authorize('update', $admin);
        
        $admin->update([
            'is_active' => !$admin->is_active
        ]);

        return back()->with('success', 'Admin status updated successfully.');
    }
}