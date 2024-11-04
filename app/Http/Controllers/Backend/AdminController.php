<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role_id', User::ROLE_ADMIN)->get();

        return view('backend.user.admin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users', 'max: 255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'name' => ['required', 'string', 'max:255'],
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role_id' => User::ROLE_ADMIN,
        ]);

        session()->flash('success', 'Admin created successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('backend.user.admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $admin = User::findOrFail($id);
        $admin->update($validated);

        session()->flash('success', 'Admin data updated successfully.');
        return redirect()->route('admin.index');
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'Admin deleted successfully.');
        return redirect()->route('admin.index');
    }
}
