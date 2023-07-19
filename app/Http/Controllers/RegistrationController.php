<?php

// app/Http/Controllers/RegistrationController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        // Display the registration form view
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate the user registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Log in the user after successful registration (optional)
        auth()->login($user);

        // Redirect to the dashboard or desired page after registration
        return redirect('/dashboard')->with('success', 'Registration successful! Welcome to Uprise Sacco.');
    }
}
