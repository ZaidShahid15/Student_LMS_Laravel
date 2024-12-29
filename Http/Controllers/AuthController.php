<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserREquest;
use App\Models\auther;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function regiester()
    {
        return view('register');
    }

    public function register_user(UserREquest $req)
    {
        if ($req->password == $req->confirm_password) {
            $model = User::create($req->all());
            $model->password = Hash::make($req->password);
            $model->save();
            return redirect()->route('home');
        }
        return redirect()->back()->with('error', 'password not matched');
    }

    public function login_user(LoginRequest $req)
    {

        if (Auth::attempt($req->only('email', 'password'))) {
            $role = roles::where('id', Auth::user()->role_id)->first();
            if (Auth::user()->role_id == $role->id && $role->name == 'admin') {
                return redirect()->route('home');
            }
            return redirect()->route('home');
        }
        Auth::logout();
        return redirect()->back()->with('error', 'wrong credential');
    }


    public function forget()
    {
        return view('forget');
    }


    public function findemail(Request $req)
    {
        $req->validate([
            'email' => 'required|email'
        ]);
        $email = $req->email;
        $user['user'] = User::where('email', $email)->first();
        if (!empty($user['user'])) {
            return view('password', $user);
        }
        return redirect()->back()->with('error', 'email not found');
    }

    public function setpassword(Request $req, $id)
    {
        $req->validate([
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
        if ($req->password == $req->confirm_password) {
            // dd($id);
            $user = User::find($id);
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect()->route('login')->with('success', 'password changed');
        }

        return redirect()->back()->with('error', 'password not match');
    }
}
