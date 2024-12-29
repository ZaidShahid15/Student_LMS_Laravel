<?php

namespace App\Http\Controllers;

use App\Models\book_issued_students;
use App\Models\books;
use App\Models\request as ModelsRequest;
use App\Models\roles_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RequestController extends Controller
{

    public function index()
    {

        $data['requestData'] = ModelsRequest::with(['book', 'user'])->get();
        $data['compare'] = book_issued_students::get();
        if(Gate::allows('RequestView',roles_permission::class)){
            return view('admin.request', $data);

        }
    }


    public function store(Request $request)
    {
        $book_id = $request->query('book_id');

        $existingRequest = ModelsRequest::where('book_id', $book_id)->where('user_id', Auth::user()->id)->first();

        if ($existingRequest) {
            $existingRequest->update([
                'request' => 0
            ]);

            $data = $existingRequest;
        } else {
            $data = ModelsRequest::create([
                'book_id' => $book_id,
                'user_id' => Auth::user()->id,
                'request' => 0
            ]);
        }

        return response()->json([
            'success' => 'yes',
        ]);
    }


    public function setRequest($id)
    {
        $data = ModelsRequest::find($id);
        $data->update([
            'request' => 1
        ]);
        return response()->json([
            'success' => 'Successfully accept',
        ]);
    }
}
