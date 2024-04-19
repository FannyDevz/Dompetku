<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('username', $request->username)
            ->first();

        if ($user) {
            if ($user->email === $request->email) {
                return redirect()->back()->with('error', 'Email already exists');
            } else {
                return redirect()->back()->with('error', 'Username already exists');
            }
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        return redirect()->route('login')->with('success', 'User created successfully');
    }
}
