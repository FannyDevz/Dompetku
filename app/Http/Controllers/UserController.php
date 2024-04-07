<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::where('id', Auth::user()->id);

        return view('user.user.index' , ['user' => $user->first()]);
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        if ($request->password) {
            $validate['password'] = bcrypt($request['password']);
        }

        try {
            User::where('id', Auth::user()->id)->update($validate);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }
}
