<?php

namespace App\Http\Controllers;

use App\Models\book_issued_students;
use App\Models\books;
use App\Models\roles;
use App\Models\roles_permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $role = roles::where('id', Auth::user()->role_id)->first();

        $user = User::find(Auth::user()->id);


        $sir = User::where('role_id', function ($query) {
            $query->select('id')->from('roles')->where('name', 'student');
        })->count();


        $books = [
            'book' => books::count(),
            'issued' => book_issued_students::where('user_id', $user->id)->count(),
            'totalIssuedBooks' => book_issued_students::count(),
            'user' => $sir
        ];

        if (Auth::user()->role_id == $role->id && $role->name == 'admin') {
            if(Gate::allows('dashboardView',roles_permission::class)){
                return view('admin.dashboard', $books);

            }else{
                abort(401);
            }
        }
        if(Gate::allows('dashboardView',roles_permission::class)){

        return view('home', $books);
        }else{
            abort(401);
        }
    }


    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
