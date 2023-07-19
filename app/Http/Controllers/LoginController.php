<?php
// app/Http/Controllers/LoginController.php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Find the member by username
        $member = Member::where('username', $username)->first();

        if ($member) {
            // Check if the password matches
            if ($member->password === $password) {
                // Authentication successful
                // Return the secure menu items or redirect to the appropriate page
                return response()->json([
                    'status' => 'success',
                    'message' => 'Authentication successful',
                    'menu' => [
                        'command' => '...',
                        // List of secure menu items
                    ]
                ]);
            }
        }

        // Invalid credentials
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid username or password',
        ], 401);
    }
}
