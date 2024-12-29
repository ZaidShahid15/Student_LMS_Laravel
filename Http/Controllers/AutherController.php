<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\auther;
use App\Models\roles_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Can;

class AutherController extends Controller
{
    public function index(Request $request)
    {

    $query = auther::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $data['authors'] = $query->paginate(5);

        if(Gate::allows('AuthView',roles_permission::class)){
            return view('admin.auther.auther', $data);

        }else{
            abort(403);
        }


    }


    public function addAuth(AuthRequest $req)
    {
        $auther = auther::create($req->all());
        if (!empty($auther)) {
            return response()->json([
                'success' => 'auther create successfully',
                'data' => $auther
            ]);
        }

        return response()->json([
            'error' => 'Haveing issue',
        ]);
    }
    public function editauth($id)
    {
        $data = auther::find($id);

        if (!$data) {
            return response()->json([
                'error' => 'value not get',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function update(AuthRequest $req, $id)
    {
        $data  = auther::find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Id not found',
            ]);
        }

        $data->update($req->all());

        if (!empty($data)) {
            return response()->json([
                'success' => 'Author update successfully',
                'data' => $data,
            ]);
        }
    }

    public function dellete($id)
    {
        $data = auther::find($id);

        if (!$data) {
            return response()->json([
                'error' => 'id not found',
            ]);
        }

        $data->delete();
        return response()->json([
            'success' => 'Author delete Succesfuly',
        ]);
    }
}
