<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (!Auth::user()->is_admin) {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. Admin privileges required.']);
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function profile()
    {
        return view('admin.auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $v = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $v['password'] = bcrypt($request->password);
        }
        $user->update($v);
        return back()->with('success', 'Profile updated.');
    }
}
