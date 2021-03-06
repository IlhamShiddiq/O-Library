<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categories;
use App\Models\Publisher;
use App\Models\Transaction;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use App\Imports\BookImport;
use Maatwebsite\Excel\Facades\Excel;

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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $paginate = Config::all();
        $isSearch = '';
 
        $books = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.id', 'books.isbn', 'books.publisher_id', 'books.category_id', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'books.publish_year', 'publishers.publisher', 'categories.category')
            ->paginate($paginate[0]->book_list_page);

        $count = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.id', 'books.publisher_id', 'books.category_id', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'publishers.publisher', 'categories.category')
            ->count();
        
        return view('librarian/data-book', compact('books', 'count', 'isSearch'));
        // dd($books);
    }

    public function bookDetail(Book $book) {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $book_data = Book::join('publishers', 'books.publisher_id', '=', 'publishers.id')
                        ->join('categories', 'books.category_id', '=', 'categories.id')
                        ->select('books.*', 'publishers.publisher', 'categories.category')
                        ->where('books.id', $book->id)
                        ->get();
        
        return view('librarian.detail-book', ['data' => $book_data[0]]);
    }

    public function bookHistory(Book $book)
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $histories = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('users', 'transactions.member_id', '=', 'users.id')
                                ->where('book_id', $book->id)
                                ->get();

        $count = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('users', 'transactions.member_id', '=', 'users.id')
                                ->where('book_id', $book->id)
                                ->count();

        return view('librarian/data-book-history', compact('histories', 'count'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judulBuku' => 'required',
            'penerbitBuku' => 'required',
            'kategoriBuku' => 'required',
            'penulisBuku' => 'required',
            'stokBuku' => 'required',
            'isbnBuku' => 'required',
            'tahunTerbit' => 'required|max:4',
            'tentangBuku' => 'required',
            'gambarBuku' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $isbn = chop($request->isbnBuku, 'e');  
        $isbn = str_replace('-', '', $isbn);

        $cat = Categories::where('id', $request->kategoriBuku)->get();
        $pub = Publisher::where('id', $request->penerbitBuku)->get();

        if($cat->all() && $pub->all())
        {
            $file = $request->file('gambarBuku');

            if($file) $image = $file->getClientOriginalName();
            else $image = "book-default.png";

            $book = Book::create([
                'isbn' => $isbn,
                'title' => $request->judulBuku,
                'publisher_id' => $request->penerbitBuku,
                'author' => $request->penulisBuku,
                'category_id' => $request->kategoriBuku,
                'qty' => $request->stokBuku,
                'image' => $image,
                'about' => $request->tentangBuku,
                'publish_year' => $request->tahunTerbit,
            ]);

            if($image != 'book-default.png') {
                Book::where('id', $book->id)
                    ->update([
                        'image' => $book->id.'/'.$image,
                        ]);
            }

            if($file) $file->move(public_path('uploaded_files/book-cover/'.$book->id.'/'),$file->getClientOriginalName());

            return redirect('/book')->with('success', 'Data berhasil ditambah');
        }
        else if($cat->all() && !($pub->all())) $err = 'ID Penerbit tidak ditemukan';
        else if(!($cat->all()) && $pub->all()) $err = 'ID Kategori tidak ditemukan';
        else $err = 'ID Penerbit dan Kategori tidak ditemukan';

        return redirect('/book')->with('failed', $err);
    }

    public function update(Request $request, Book $book)
    {
        $validateData = $request->validate([
            'judulBuku' => 'required',
            'penerbitBuku' => 'required',
            'kategoriBuku' => 'required',
            'penulisBuku' => 'required',
            'stokBuku' => 'required',
            'isbnBuku' => 'required',
            'tahunTerbit' => 'required|max:4',
            'tentangBuku' => 'required',
            'gambarBuku' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $cat = Categories::where('id', $request->kategoriBuku)->get();
        $pub = Publisher::where('id', $request->penerbitBuku)->get();

        if($cat->all() && $pub->all())
        {
            $file = $request->file('gambarBuku');

            if($file) $image = $book->id.'/'.$file->getClientOriginalName();
            else $image = $book->image;

            Book::where('id', $book->id)
                    ->update([
                        'isbn' => $request->isbnBuku,
                        'title' => $request->judulBuku,
                        'publisher_id' => $request->penerbitBuku,
                        'category_id' => $request->kategoriBuku,
                        'author' => $request->penulisBuku, 
                        'qty' => $request->stokBuku,
                        'about' => $request->tentangBuku,
                        'publish_year' => $request->tahunTerbit,
                        'image' => $image,
                        ]);

            if($file) {
                if($book->image != "book-default.png") File::delete(public_path('uploaded_files/book-cover/'.$book->image));
                $file->move(public_path('uploaded_files/book-cover/'.$book->id.'/'),$file->getClientOriginalName());
            }

            return redirect('/book')->with('success', 'Data berhasil diubah');
        }
        else if($cat->all() && !($pub->all())) $err = 'ID Penerbit tidak ditemukan';
        else if(!($cat->all()) && $pub->all()) $err = 'ID Kategori tidak ditemukan';
        else $err = 'ID Penerbit dan Kategori tidak ditemukan';

        return redirect('/book')->with('failed', $err);
    }

    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        if($book->image) {
            if($book->image != "book-default.png") File::deleteDirectory(public_path('uploaded_files/book-cover/'.$book->id));
        }

        return redirect('/book')->with('success', 'Data '.$book->title.' berhasil dihapus');
    }

    public function search(Request $request)
    {
        if($request->by == 'category') $tbl = 'categories.'.$request->by;
        else if($request->by == 'publisher') $tbl = 'publishers.'.$request->by;
        else $tbl = 'books.'.$request->by;

        $keyword = $request->search;
        if($request->by == 'isbn') {
            $keyword = chop($keyword, 'e');  
            $keyword = str_replace('-', '', $keyword);
        }

        $search = '%'.$keyword.'%';
        $isSearch = 'display: none';

        $books = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.*', 'publishers.publisher', 'categories.category')
            ->where($tbl, 'like', $search)
            ->paginate(3000);

        $count = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.*', 'publishers.publisher', 'categories.category')
            ->where($tbl, 'like', $search)
            ->count();

        return view('librarian.data-book', compact('books', 'count', 'isSearch'));
        // dd($request->request);
    }

    public function importBook(Request $request) {
        $validateData = $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new BookImport, $request->file);

        return redirect('/book')->with('success', 'Data berhasil ditambah');
    }
}
