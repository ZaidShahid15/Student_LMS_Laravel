<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudenRequest;
use App\Http\Requests\studentUpdateRequest;
use App\Models\roles;
use App\Models\roles_permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        $data['rolesdata'] = roles::get();

        $data['getRecored'] = User::getRecored($request->search);

        $data['getshowData'] = User::with('role')->get();

        if(Gate::allows('StudentView',roles_permission::class)){
            return view('admin.student.students', $data);

        }else{
            abort(401);
        }
    }




    public function add_Student(StudenRequest $req)
    {
        $data = User::create($req->all());

        $data->password = Hash::make($req->password);
        $data->save();

        if ($data) {
            $role = roles::where('id', $data->role_id)->get();

            return response()->json([
                'success' => 'Student Added Successfully',
                'data' => $data,
                'role' => $role

            ]);
        }

        return response()->json([
            'status' => 400,
            'message' => 'Something Went Wrong',
            'data' => null
        ]);
    }

    public function edit_Student($id)
    {
        $data = User::find($id);
        return response()->json([
            'success' => 200,
            'data' => $data
        ]);
    }


    public function update_Student(studentUpdateRequest $req, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found',
            ], 404);
        }

        $user->update($req->except('password'));

        if ($req->has('password')) {
            $user->password = Hash::make($req->password);
        }

        $user->save();

        $role = roles::find($user->role_id);

        return response()->json([
            'success' => 'Student Updated Successfully',
            'data' => $user,
            'role' => $role
        ]);
    }


    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return response()->json([
            'success' => 'Student Deleted Successfully',

        ]);
    }
}
