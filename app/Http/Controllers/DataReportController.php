<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Config;
use Illuminate\Http\Request;
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
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        date_default_timezone_set('Asia/Jakarta');
        $this_month = date('n');

        $paginate = Config::all();
        $config = $paginate;

        $reports = Transaction::select('transaction_id', 'name', 'nomor_induk', 'librarian_id', 'borrow_date', 'date_of_return', 'title')
                                ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('users', 'transactions.member_id', '=', 'users.id')
                                ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                                ->where('detail_transactions.status', '1')
                                ->whereMonth('detail_transactions.date_of_return', $this_month)
                                ->orderByDesc('date_of_return')
                                ->paginate($paginate[0]->report_list_page);

        $count = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('users', 'transactions.member_id', '=', 'users.id')
                            ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                            ->where('detail_transactions.status', '1')
                            ->whereMonth('detail_transactions.date_of_return', $this_month)
                            ->count();
        
        return view('librarian/data-report', compact('reports', 'count', 'config'));
    }

    public function indexLate()
    {
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $config = Config::all();

        date_default_timezone_set('Asia/Jakarta');
        $this_month = date('n');
        $reports = Transaction::select('transaction_id', 'name', 'nomor_induk', 'librarian_id', 'borrow_date', 'date_of_return', 'title')
                                ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('users', 'transactions.member_id', '=', 'users.id')
                                ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                                ->where('detail_transactions.status', '1')
                                ->where(DB::raw('DATEDIFF(date_of_return, borrow_date)'), '>', $config[0]->loan_deadline)
                                ->whereMonth('detail_transactions.date_of_return', $this_month)
                                ->orderByDesc('date_of_return')
                                ->paginate(5);

        $count = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('users', 'transactions.member_id', '=', 'users.id')
                            ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                            ->where('detail_transactions.status', '1')
                            ->where(DB::raw('DATEDIFF(date_of_return, borrow_date)'), '>', $config[0]->loan_deadline)
                            ->whereMonth('detail_transactions.date_of_return', $this_month)
                            ->count();

        return view('librarian/data-late-report', compact('reports', 'count', 'config'));
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
