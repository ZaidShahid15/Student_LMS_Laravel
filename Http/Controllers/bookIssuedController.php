<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book_Issued_Request;
use App\Models\book_issued_students;
use App\Models\books;
use App\Models\roles;
use App\Models\roles_permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class bookIssuedController extends Controller
{
    public function index(Request $request)
    {

        $query = book_issued_students::with(['book', 'students']);

        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('students', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
                ->orWhereHas('book', function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%');
                });
        }

        $data['booksShow'] = $query->paginate(5);

        $data['books'] = books::all();

        $data['student'] = User::where('role_id', '2')->get();
        if (Gate::allows('IssuedBookview',roles_permission::class)) {
        return view('admin.books.issued', $data);

        }else{
            abort(401);
        }
    }


    public function book_issue_store(Book_Issued_Request $req)
    {
        $book = book_issued_students::create($req->all());
        // $book->save();
        $book_issued = book_issued_students::with(['book', 'students'])->find($book->id);
        if ($book_issued) {
            return response()->json([
                'success' => 'Book Issued Successfully',
                'data' => $book_issued
            ]);
        }
    }

    public function book_issue_edit($id)
    {
        $book_issued = book_issued_students::find($id);
        if ($book_issued) {
            return response()->json([
                'success' => 200,
                'message' => 'Book Issued Fetched Successfully',
                'data' => $book_issued
            ]);
        }
    }

    public function book_issue_update(Book_Issued_Request $req, $id)
    {
        $data = book_issued_students::find($id);
        $data->update($req->all());
        $book_issued = book_issued_students::with(['book', 'students'])->find($data->id);
        if ($book_issued) {
            return response()->json([
                'success' => 200,
                'message' => 'Book Issued Updated Successfully',
                'data' => $book_issued
            ]);
        }
    }

    public function book_issue_delete($id)
    {
        $data  = book_issued_students::find($id);
        $data->delete();
        if ($data) {
            return response()->json([
                'success' => 'Book Issued Deleted Successfully',

            ]);
        }
    }
}
