<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller{
    
    // Redirects to the register form
    public function register() {
        return view('users.register');
    }

    // Redirects to the login form
    public function login() {
        return view("users.login");
    }

    // Adds a new user to the database
    public function store(Request $request) {
        $data = $request->validate([
            "username" => ['required', Rule::unique('users', 'username'), 'min:5', 'max:25'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => ['required', 'confirmed', 'min:5', 'max:30']
        ]);

        $data["password"] = bcrypt($data["password"]);

        $user = User::create($data);

        // Authenticates/Logs in the user
        auth()->login($user);

        return redirect("/dashboard");
    }

    // Logs in the user
    public function authenticate(Request $request) {
        $data = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);

        // Attempt a login, will skip the if statement if the login data doesn't match anything in the database
        if(auth()->attempt($data)){
            $request->session()->regenerate();
            
            return redirect("/dashboard");
        }

        return back()->withErrors(["email" => "Invalid Email or Password", "password" => "Invalid Email or Password"]);
    }

    // Logs out the user
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
