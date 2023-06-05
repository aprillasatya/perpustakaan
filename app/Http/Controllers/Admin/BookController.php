<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookBorrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.admin.form-book');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Book::create([
            'code' => Str::uuid(),
            'title' => $request->title,
            'publication_year' => $request->publication_year,
            'writer' => $request->writer,
            'stock' => $request->stock,
        ]);

        if (!is_null($book)) {
            return back()->with("success","Sukses ! Tambah Buku");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listBook(){
        $books = Book::all();
        return Datatables::of($books)
            ->addIndexColumn()
            ->make(true);
    }

    public function bookBorrowing(){
        return view('layouts.admin.borrowing-book');
    }

    public function bookBorrowingList(){
        $data = BookBorrowing::select('u.name', 'b.code', 'b.title', 'book_borrowings.status')
                                ->leftJoin('users as u', 'book_borrowings.user_id', '=', 'u.id')
                                ->leftJoin('books as b', 'book_borrowings.book_id', '=', 'b.id');
        return Datatables::of($data->get())
            ->addIndexColumn()
            ->addColumn('status', function($row){
                if($row->status == 1){
                    return 'Pending';
                }else if($row->status == 2){
                    return 'Approved';
                }else if($row->status == 3){
                    return 'Rejected';
                }
            })
            ->addColumn('action', function($row){
                return [
                    'id' => $row->id
                ];
            })
            ->make(true);
    }
}
