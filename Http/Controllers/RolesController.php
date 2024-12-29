<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Requests\upRoleReuest;
use App\Models\permission;
use App\Models\roles;
use App\Models\roles_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function index(Request $req)
    {

        $data['getpermission'] = permission::getpermission();

        $query = roles::query();

        if ($req->has('search') && !empty($req->search)) {
            $query->where('name', 'like', '%' . $req->search . '%');
        }

        $data['role'] = $query->paginate(5);

        if (Gate::allows('Rolesview',roles_permission::class)) {
            return view('admin.role_permission.roles', $data);
        }else{
            abort(401);
        }

    }


    public function addpermission(RoleRequest $req)
    {

        $data = $req->except('_token');

        $role =  roles::create($data);
        $permission =  roles_permission::InsertUpdateRecored($req->permission_id, $role->id);


        if ($role) {
            return response()->json([
                'success' => 'successfully add',
                'data' => $role
            ]);
        }
    }

    public function editpermission($id)
    {
        $data['getSingle'] = roles::find($id);

        $permissionGet = permission::get();
        $data['permissionGet'] = $permissionGet;

        $data['getRolePermisssion'] = roles_permission::where('role_id', $id)->get();

        return response()->json([
            'role' => $data
        ]);
    }

    public function updatepermission(upRoleReuest $req, $id)
    {
        $save = roles::findorfail($id);
        $save->name = $req->name;
        $save->save();
        roles_permission::InsertUpdateRecored($req->permission_id, $save->id);
        return response()->json([
            'success' => 'successfully update',
            'data' => $save
        ]);
    }

    public function delete($id)
    {
        $save = roles::findorfail($id);
        $save->delete();
        return response()->json([
            'success' => 'successfully delete',
        ]);
    }
}
