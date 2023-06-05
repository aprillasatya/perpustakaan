<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookBorrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    public function index(){
        return view('layouts.list-book-member');
    }
    public function listBook(){
        $books = Book::all();
        return Datatables::of($books)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return [
                    'id' => $row->id
                ];
            })
            ->make(true);
    }
    public function borrowingBook(Request $request){
        $data = BookBorrowing::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id,
            'status' => 1,
            'borrowing_date' => $request->borrowing_date,
            'return_date' => $request->return_date,
        ]);

        if (!is_null($data)) {
            // $book = Book::find($request->book_id);
            // Book::where('id', $request->book_id)
            //     ->update(['stock' => (int)$book->stock - 1]);
            return back()->with("success","Sukses ! Pinjam Buku");
        }
    }
}
