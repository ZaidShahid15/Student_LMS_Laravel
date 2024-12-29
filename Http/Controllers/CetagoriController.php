<?php

namespace App\Http\Controllers;

use App\Http\Requests\cetagoriRequest;
use App\Models\categori;
use App\Models\permission;
use App\Models\roles;
use App\Models\roles_permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;

class CetagoriController extends Controller
{
    public function index(Request $request)
    {
        $query = categori::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $data['cetagori'] = $query->paginate(5);

        if (Gate::allows('category', roles_permission::class)) {
            return view('admin.cetagori.cetagori', $data);
        } else {
            abort(403);
        }
    }

    public function store(cetagoriRequest $req)
    {

        $data = categori::create($req->all());
        if (!empty($data)) {
            return response()->json([
                'success' => true,
                'message' => 'cetagori add successfully',
                'data' => $data,
            ]);
        }
    }

    public function getRecored($id)
    {
        $data = categori::find($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function update(CetagoriRequest $req, $id)
    {
        $data = Categori::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ]);
        }


        $data->update($req->all());

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
            'data' => $data,
        ]);
    }

    public function delete($id)
    {
        $data  = categori::find($id);
        $data->delete();
        if (!empty($data)) {
            return response()->json([
                'success' => 'deleted succssfully'
            ]);
        }
    }
}
