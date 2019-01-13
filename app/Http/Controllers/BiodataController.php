<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
     public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $books = Book::with('author', 'category');//Penggunaan method with() akan meload relasi dari Book ke Author dengan teknik eager loading
          return Datatables::of($books)
                ->addColumn('action', function($book){
                    return view('datatable._action', [
                        'model'           => $book,
                        'form_url'        => route('books.destroy', $book->id),
                        'edit_url'        => route('books.edit', $book->id),
                        'show_url'        => route('books.show', $book->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $book->title . '?',

                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'title', 'name'=>'title', 'title'=>'Judul'])
            ->addColumn(['data' => 'author.name', 'name'=>'author.name', 'title'=>'Penulis'])
            ->addColumn(['data' => 'category.name', 'name'=>'category.name', 'title'=>'Kategori'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);


        return view('books.index')->with(compact('html'));
    }

}
