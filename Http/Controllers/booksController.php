<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\auther;
use App\Models\books;
use App\Models\categori;
use App\Models\request as ModelsRequest;
use App\Models\roles;
use App\Models\roles_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class booksController extends Controller
{
    public function books(Request $request)
    {


        $data['cetagori'] = categori::get();
        $data['author'] = auther::get();
        $data['request'] = ModelsRequest::get();

        $query = books::with(['category', 'author']);

        if ($request->has('search') && !empty($request->search)) {
            $query->where('isbn', 'like', '%' . $request->search . '%');
        }
        $data['role'] = roles::where('name','admin')->first();
        $data['book'] = $query->paginate(5);

        if(Gate::allows('BookView',roles_permission::class)){
            return view('admin.books.book', $data);

        }else{
            abort(401);
        }
    }


    public function addbooks(BookRequest $req)
    {

        $book = books::create($req->all());
        $book->isbn = $book->title . '-' . $book->id;
        $book->save();
        if (!$book) {
            return response()->json([
                'error' => 'There was an error while adding the book.',
            ]);
        }

        $data = books::with(['category', 'author'])->find($book->id);
        return response()->json([
            'success' => 'Book added successfully!',
            'data' => $data
        ]);
    }

    public function edit($id)
    {
        $book = books::find($id);
        $data = books::with(['category', 'author'])->find($book->id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function updatebook(BookRequest $req, $id)
    {
        $book = books::find($id);
        $book->update($req->all());
        $data = books::with(['category', 'author'])->find($book->id);
        if (!empty($book)) {
            return response()->json([
                'success' => 'yes',
                'data' => $data
            ]);
        }

        return response()->json([
            'error' => 'nothing'
        ]);
    }

    public function deletebook($id)
    {
        $book = books::find($id);
        $book->delete();
        if ($book) {
            return response()->json([
                'success' => 'successfuly deleted',
            ]);
        }
    }

    public function access($id)
    {
        $data = books::where('id', $id)->first();
        $data->request = 0;
        $data->save();
        return response()->json([
            'success' => 'Access Granted Successfully',
            'data' => $data
        ]);
    }
}
