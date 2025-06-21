<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view('admin.home', compact('accounts'));
    }
    public function store(Request $request)
    {
        // dd('Masuk ke store');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Account::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'email_verified_at' => now()
        ]);

        return redirect()->route('admin.home')->with('success', 'Account created successfully.');
    }
    public function update(Request $request, $id)
    {
        $accounts  = Account::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $accounts ->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $accounts ->name = $request->name;
        $accounts ->email = $request->email;

        if ($request->filled('password')) {
            $accounts ->password = bcrypt($request->password);
        }

        $accounts ->save();

        return redirect()->route('admin.home')->with('success', 'Account updated successfully.');
    }
    public function destroy($id)
    {
        $accounts = Account::findOrFail($id);
        $accounts->delete();

        return redirect()->route('admin.home')->with('success', 'Account deleted successfully.');
    }
}
