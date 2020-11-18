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
        return view('member.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book()
    {
        $books = DB::table('books')
            ->select('books.id', 'books.title', 'books.image')
            ->where('books.qty', '>', 0)
            ->paginate(8);
        
        return view('member.data-book', compact('books'));
    }

    public function bookDetail(Book $book)
    {
        $id = $book->id;

        $datas = DB::table('books')
            ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.id', 'books.title', 'books.author', 'books.qty', 'books.image', 'books.about', 'publishers.publisher', 'categories.category')
            ->where('books.id', $id)
            ->get();

        return view('member.detail-book', compact('datas'));
    }

    public function ebook()
    {
        $ebooks = DB::table('ebooks')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.image')
            ->paginate(8);

        return view('member.data-ebook', compact('ebooks'));
    }

    public function ebookDetail(Ebook $ebook)
    {
        $id = $ebook->id;

        $datas = DB::table('ebooks')
            ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
            ->join('categories', 'ebooks.category_id', '=', 'categories.id')
            ->select('ebooks.id', 'ebooks.title', 'ebooks.author', 'ebooks.image', 'ebooks.about', 'publishers.publisher', 'categories.category')
            ->where('ebooks.id', $id)
            ->get();

        return view('member.detail-ebook', compact('datas'));
    }

    public function myEbook()
    {
        return view('member.my-ebook');
    }

    public function myEbookPreview()
    {
        return view('member.my-ebook-preview');
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
        return view('member/edit-profile');
    }

    public function editPass()
    {
        return view('member/change-password');
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
