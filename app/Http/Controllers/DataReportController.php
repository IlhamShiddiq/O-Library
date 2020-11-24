<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DataReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this_month = date('n');
        $reports = Transaction::select('transaction_id', 'name', 'nomor_induk', 'librarian_id', 'borrow_date', 'date_of_return', 'title')
                                ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('users', 'transactions.member_id', '=', 'users.id')
                                ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                                ->where('detail_transactions.status', '1')
                                ->whereMonth('detail_transactions.date_of_return', $this_month)
                                ->orderByDesc('date_of_return')
                                ->paginate(5);
        
        return view('librarian/data-report', compact('reports'));
    }

    public function indexLate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this_month = date('n');
        $reports = Transaction::select('transaction_id', 'name', 'nomor_induk', 'librarian_id', 'borrow_date', 'date_of_return', 'title')
                                ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('users', 'transactions.member_id', '=', 'users.id')
                                ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                                ->where('detail_transactions.status', '1')
                                ->where(DB::raw('DATEDIFF(date_of_return, borrow_date)'), '>', '14')
                                ->whereMonth('detail_transactions.date_of_return', $this_month)
                                ->orderByDesc('date_of_return')
                                ->paginate(5);

        return view('librarian/data-late-report', compact('reports'));
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

    public function reportSearch(Request $request)
    {
        if($request->by == 'nomor_induk') $tbl = 'users.'.$request->by;
        else if($request->by == 'borrow_date') $tbl = 'transactions.'.$request->by;
        else $tbl = 'detail_transactions.'.$request->by;

        $search = '%'.$request->search.'%';

        date_default_timezone_set('Asia/Jakarta');
        $this_month = date('n');

        $reports = Transaction::select('transaction_id', 'name', 'nomor_induk', 'librarian_id', 'borrow_date', 'date_of_return', 'title')
                                ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('users', 'transactions.member_id', '=', 'users.id')
                                ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                                ->where('detail_transactions.status', '1')
                                ->where($tbl, 'like', $search)
                                ->whereMonth('detail_transactions.date_of_return', $this_month)
                                ->orderByDesc('date_of_return')
                                ->paginate(30000);

        return view('librarian/data-report', compact('reports'));
    }
}
