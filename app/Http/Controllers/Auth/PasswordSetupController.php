<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PasswordSetupController extends Controller
{
    public function create()
    {
        // If they don't need a reset, redirect home
        if (!auth()->user()->require_password_reset) {
            return redirect()->route('dashboard');
        }

        return view('auth.setup-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->require_password_reset = false;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'Password updated successfully!');
    }
}
