<?php

namespace App\Http\Controllers;

use App\Models\book_issued_students;

class StudDashboardController extends Controller
{
    public function index()
    {
        $data['booksShow'] = book_issued_students::with(['book', 'students'])->where('user_id', auth()->user()->id)->get();
        return view('stud_dashboard',$data);
    }

    public function returend($id){
        $book = book_issued_students::find($id);
        $book->returned_at = now()->toDateString();
        $book->save();
        if($book){
            return response()->json([
                'success' => "returned book now",
                'data' => $book,
            ]);
        }
    }
}
