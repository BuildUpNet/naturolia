<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountReactivationMail;

class AuthController extends Controller
{


   public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'status' => 'active',
    ]);

    return back()->with('success', 'Registration successful! Please wait for admin approval.');
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Fetch the user first
    $user = User::where('email', $request->email)->first();

    // Check if user exists
    if (!$user) {
        return back()->with('error', 'The provided credentials do not match our records.');
    }

    // Check if password is correct
    if (!Hash::check($request->password, $user->password)) {
        return back()->with('error', 'The provided credentials do not match our records.');
    }

    // Check if user is active
    if ($user->status !== 'active') {
        // Generate reactivation token and expiry
        $user->reactivation_token = Str::random(60);
        $user->reactivation_expires_at = now()->addMinutes(10);
        $user->save();

        // Send reactivation email
        Mail::to($user->email)->send(new AccountReactivationMail($user));

        return back()->with('error', 'Your account is deactivated. We have sent you an email to reactivate your account. The link is valid for 10 minutes.');
    }

    // Only active users can log in
    Auth::login($user);
    $request->session()->regenerate();

    // Redirect based on role
    if ($user->role === 'admin') {
        return redirect()->route('Admin.Dashboard')
            ->with('success', 'Welcome back, Admin!');
    }

    return redirect()->route('home')
        ->with('success', 'Login successful! Welcome back.');
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');  // Redirects to the home page
}
}
