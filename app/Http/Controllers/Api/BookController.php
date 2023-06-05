<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return response()->json([
               'message'   => 'success',
               'data'      => Book::all()
               ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByCode($code)
    {
        return response()->json([
               'message'   => 'success',
               'data'      => Book::where('code', $code)->get()
               ], 200);
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
            return response()->json([
               'message'   => 'success',
               'data'      => $book
               ], 200);
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
    public function update(Request $request, $code)
    {
        $book = Book::where('code', $code)
                ->update([
                    'title' => $request->title,
                    'publication_year' => $request->publication_year,
                    'writer' => $request->writer,
                    'stock' => $request->stock,
                ]);

        if (!is_null($book)) {
            return response()->json([
               'message'   => 'success'
               ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $book = Book::where('code', $code)->delete();
        if (!is_null($book)) {
            return response()->json([
               'message'   => 'success'
               ], 200);
        }
    }
}
