<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Ebook;

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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        return view('member.dashboard');
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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $books = DB::table('books')
            ->select('books.id', 'books.title', 'books.image')
            ->where('books.qty', '>', 0)
            ->paginate(8);
        
        return view('member.data-book', compact('books'));
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
            ->select('books.id', 'books.isbn', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'publishers.publisher', 'categories.category')
            ->where('books.id', $id)
            ->get();

        return view('member.detail-book', compact('datas'));
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
                    ->select('books.id', 'books.title', 'books.image')
                    ->where($by, 'like', $search)
                    ->where('books.qty', '>', 0)
                    ->paginate(3000);
        
        return view('member.data-book', compact('books'));
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

        return view('member.data-ebook', compact('ebooks'));
    }

    public function ebookDetail(Ebook $ebook)
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $id = $ebook->id;

        $datas = DB::table('ebooks')
            ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
            ->join('categories', 'ebooks.category_id', '=', 'categories.id')
            ->select('ebooks.id', 'ebooks.isbn', 'ebooks.title', 'ebooks.author', 'ebooks.image', 'ebooks.about', 'publishers.publisher', 'categories.category')
            ->where('ebooks.id', $id)
            ->get();

        return view('member.detail-ebook', compact('datas'));
    }
    
    public function ebookSearch(Request $request)
    {
        $search = '%'.$request->search.'%';
        
        $ebooks = DB::table('ebooks')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.image')
            ->where('ebooks.title', 'like', $search)
            ->paginate(3000);
        
        return view('member.data-ebook', compact('ebooks'));
    }

    public function myEbook()
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }

        $ebooks = DB::table('ebooks')
            ->join('permissions', 'permissions.id_ebook', '=', 'ebooks.id')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.link', 'permissions.limit_date')
            ->where('permissions.id_member', auth()->user()->id)
            ->where('permissions.id_ebook', $ebook->id)
            ->get();

        $link = substr($ebooks[0]->link, 0, strpos($ebooks[0]->link, 'view?usp=sharing')).'preview';

        return view('member.my-ebook-preview', compact('ebooks', 'link'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit()
    {
        
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
}
