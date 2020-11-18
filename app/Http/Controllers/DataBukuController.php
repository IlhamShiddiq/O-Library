<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categories;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class DataBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $books = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.id', 'books.publisher_id', 'books.category_id', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'publishers.publisher', 'categories.category')
            ->paginate(5);

        $count = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.id', 'books.publisher_id', 'books.category_id', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'publishers.publisher', 'categories.category')
            ->count();
        
        return view('librarian/data-book', compact('books', 'count'));
        // dd($books);
    }

    public function bookHistory()
    {
        return view('librarian/data-book-history');
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
        $validateData = $request->validate([
            'judulBuku' => 'required',
            'penerbitBuku' => 'required',
            'kategoriBuku' => 'required',
            'penulisBuku' => 'required',
            'stokBuku' => 'required',
            'tentangBuku' => 'required',
            'gambarBuku' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $cat = Categories::where('id', $request->kategoriBuku)->get();
        $pub = Publisher::where('id', $request->penerbitBuku)->get();

        if($cat->all() && $pub->all())
        {
            $file = $request->file('gambarBuku');

            if($file) $image = $file->getClientOriginalName();
            else $image = "book-default.png";

            $book = new Book;
            $book->title = $request->judulBuku;
            $book->publisher_id = $request->penerbitBuku;
            $book->author = $request->penulisBuku;
            $book->category_id = $request->kategoriBuku;
            $book->qty = $request->stokBuku;
            $book->image = $image;
            $book->about = $request->tentangBuku;
            $book->save();

            if($file) $file->move(public_path('uploaded_files/book-cover/'),$file->getClientOriginalName());

            return redirect('/book')->with('success', 'Data berhasil ditambah');
        }
        else if($cat->all() && !($pub->all())) $err = 'ID Penerbit tidak ditemukan';
        else if(!($cat->all()) && $pub->all()) $err = 'ID Kategori tidak ditemukan';
        else $err = 'ID Penerbit dan Kategori tidak ditemukan';

        return redirect('/book')->with('failed', $err);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validateData = $request->validate([
            'judulBuku' => 'required',
            'penerbitBuku' => 'required',
            'kategoriBuku' => 'required',
            'penulisBuku' => 'required',
            'stokBuku' => 'required',
            'tentangBuku' => 'required',
            'gambarBuku' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $cat = Categories::where('id', $request->kategoriBuku)->get();
        $pub = Publisher::where('id', $request->penerbitBuku)->get();

        if($cat->all() && $pub->all())
        {
            $file = $request->file('gambarBuku');

            if($file) $image = $file->getClientOriginalName();
            else $image = $book->image;

            Book::where('id', $book->id)
                    ->update([
                        'title' => $request->judulBuku,
                        'publisher_id' => $request->penerbitBuku,
                        'category_id' => $request->kategoriBuku,
                        'author' => $request->penulisBuku,
                        'qty' => $request->stokBuku,
                        'about' => $request->tentangBuku,
                        'image' => $image,
                        ]);

            if($file) {
                if($book->image != "book-default.png") File::delete(public_path('uploaded_files/book-cover/'.$book->image));
                $file->move(public_path('uploaded_files/book-cover/'),$file->getClientOriginalName());
            }

            return redirect('/book')->with('success', 'Data berhasil diubah');
        }
        else if($cat->all() && !($pub->all())) $err = 'ID Penerbit tidak ditemukan';
        else if(!($cat->all()) && $pub->all()) $err = 'ID Kategori tidak ditemukan';
        else $err = 'ID Penerbit dan Kategori tidak ditemukan';

        return redirect('/book')->with('failed', $err);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        if($book->image) {
            if($book->image != "book-default.png") File::delete(public_path('uploaded_files/book-cover/'.$book->image));
        }

        return redirect('/book')->with('success', 'Data '.$book->title.' berhasil dihapus');
        // dd($book);
    }

    public function returnBook()
    {
        return view('librarian/return-book');
    }

    public function search(Request $request)
    {
        if($request->by == 'category') $tbl = 'categories.'.$request->by;
        else if($request->by == 'publisher') $tbl = 'publishers.'.$request->by;
        else $tbl = 'books.'.$request->by;

        $search = '%'.$request->search.'%';

        $books = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.id', 'books.publisher_id', 'books.category_id', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'publishers.publisher', 'categories.category')
            ->where($tbl, 'like', $search)
            ->paginate(3000);

        $count = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.id', 'books.publisher_id', 'books.category_id', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'publishers.publisher', 'categories.category')
            ->where($tbl, 'like', $search)
            ->count();

        return view('librarian.data-book', compact('books', 'count'));
        // dd($request->request);
    }
}
