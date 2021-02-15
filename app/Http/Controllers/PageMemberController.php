<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Ebook;
use App\Models\Config;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $data = Config::select('bg_member')
                    ->where('id', 1)
                    ->get();
 
        return view('member.dashboard', ['bg' => $data[0]->bg_member]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book()
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }
 
        $books = DB::table('books')
            ->select('books.id', 'books.title', 'books.image', 'books.qty')
            ->paginate(8);
 
        $counter = DB::table('books')
            ->select('books.id', 'books.title', 'books.image', 'books.qty')
            ->count();
        
        return view('member.data-book', compact('books', 'counter'));
    }

    public function bookDetail(Book $book)
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $id = $book->id;

        $datas = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.*', 'publishers.publisher', 'categories.category')
            ->where('books.id', $id)
            ->get();

        return view('member.detail-book', ['data' => $datas[0]]);
    }

    public function bookSearch(Request $request)
    {
        if(!($request->by))
        {
            $by = 'books.title';
        }
        else
        {
            if($request->by == 'title' || $request->by == 'author')
            {
                $by = 'books.'.$request->by;
            }
            else if($request->by == 'category')
            {
                $by = 'categories.'.$request->by;
            }
            else
            {
                $by = 'publishers.'.$request->by;
            }
        }
        
        $search = '%'.$request->search.'%';
        
        $books = DB::table('books')
                    ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                    ->join('categories', 'books.category_id', '=', 'categories.id')
                    ->select('books.id', 'books.title', 'books.image', 'books.qty')
                    ->where($by, 'like', $search)
                    ->paginate(3000);
        
        $counter = DB::table('books')
                    ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                    ->join('categories', 'books.category_id', '=', 'categories.id')
                    ->select('books.id', 'books.title', 'books.image', 'books.qty')
                    ->where($by, 'like', $search)
                    ->count();
        
        return view('member.data-book', compact('books', 'counter'));
    }

    public function ebook()
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $ebooks = DB::table('ebooks')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.image')
            ->paginate(8);
 
        $counter = DB::table('ebooks')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.image')
            ->count();

        return view('member.data-ebook', compact('ebooks', 'counter'));
    }

    public function ebookDetail(Ebook $ebook)
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }
 
        $id = $ebook->id;

        $datas = DB::table('ebooks')
            ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
            ->join('categories', 'ebooks.category_id', '=', 'categories.id')
            ->select('ebooks.*', 'publishers.publisher', 'categories.category')
            ->where('ebooks.id', $id)
            ->get();

        return view('member.detail-ebook', ['data' => $datas[0]]);
    }
    
    public function ebookSearch(Request $request)
    {
        $search = '%'.$request->search.'%';
        
        $ebooks = DB::table('ebooks')
                    ->select('ebooks.id', 'ebooks.title', 'ebooks.image')
                    ->where('ebooks.title', 'like', $search)
                    ->paginate(3000);
        
        $counter = DB::table('ebooks')
                    ->select('ebooks.id', 'ebooks.title', 'ebooks.image')
                    ->where('ebooks.title', 'like', $search)
                    ->count();
        
        return view('member.data-ebook', compact('ebooks', 'counter'));
    }

    public function myEbook()
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $id = auth()->user()->id;

        $ebooks = DB::table('ebooks')
            ->join('permissions', 'permissions.id_ebook', '=', 'ebooks.id')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.image', 'permissions.confirmed', 'permissions.accepted', 'permissions.limit_date', 'permissions.reason_for_rejection')
            ->where('permissions.id_member', $id)
            ->get();
 
        return view('member.my-ebook', compact('ebooks'));
    }
     
    public function myEbookPreview(Ebook $ebook)
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        date_default_timezone_set('Asia/Jakarta');

        $ebooks = DB::table('ebooks')
            ->join('permissions', 'permissions.id_ebook', '=', 'ebooks.id')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.link', 'permissions.limit_date')
            ->where('permissions.id_member', auth()->user()->id)
            ->where('permissions.id_ebook', $ebook->id)
            ->where('permissions.accepted', '1')
            ->where('permissions.limit_date', '>', date('Y-m-d'))
            ->get();

        $link = substr($ebooks[0]->link, 0, strpos($ebooks[0]->link, 'view?usp=sharing')).'preview';

        return view('member.my-ebook-preview', compact('ebooks', 'link'));
    }
}
