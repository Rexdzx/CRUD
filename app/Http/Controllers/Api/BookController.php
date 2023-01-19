<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        if($books){
            return response()->json([
                'data' => $books,
                'message' => 'Berhasil Mengambil Semua Buku',
                'status' => 200,
            ]);
        }

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
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'pembuat' => 'required',
        ]);

        $buku = Book::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'pembuat' => $request->pembuat,
        ]);

        $book = Book::where('id', '=', $buku->id)->get();

        return response()->json([
            'data' => $book,
            'message' => 'Berhasil Membuat Buku Baru',
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::where('id', '=', $id)->get();

        return response()->json([
            'data' => $book,
            'message' => 'Berhasil Mengambil Buku',
            'status' => 200,
        ]);
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
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'pembuat' => 'required',
        ]);

        $buku = Book::findOrFail($id);
        $buku->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'pembuat' => $request->pembuat
        ]);

        return response()->json([
            'data' => $buku,
            'message' => 'Berhasil Update Buku',
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Book::findOrFail($id);
        $buku->delete();

        if($buku){
            return response()->json([
                'data' => [],
                'message' => 'Berhasil Menghapus Buku',
                'status' => 200,
        ]);
        }  
        }
}
