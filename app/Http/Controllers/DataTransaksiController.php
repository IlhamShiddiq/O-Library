<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Detail_Transactions;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTransaksiController extends Controller
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

        $datas = Transaction::select('transactions.id', 'users.nomor_induk', 'users.name', DB::raw('COUNT("transaction_id") as sum'))
                            ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('users', 'transactions.member_id', '=', 'users.id')
                            ->where('detail_transactions.status', '0')
                            ->groupBy('transactions.id', 'users.name', 'users.nomor_induk')
                            ->orderBy('transactions.id')
                            ->paginate(5);

        return view('librarian/data-transaction', compact('datas'));
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
            'nomorIndukMember' => 'required',
            'idBukuPertama' => 'required'
        ]);

        if($request->jumlahPinjam == 2)
        {
            if($request->idBukuKedua == null)
            {
                return redirect('/transaction')->with('failed', 'Data belum lengkap');
            }

            if($request->idBukuPertama == $request->idBukuKedua)
            {
                return redirect('/transaction')->with('failed', 'Buku yang dipinjam tidak boleh sama');
            }
        }

        $id = User::select('id')
                    ->where('nomor_induk', $request->nomorIndukMember)
                    ->where('role', 'Member')
                    ->get();

        if($id->all())
        {
            // Buku pertama yang dipinjam
            $id_buku1 = Book::where('id', $request->idBukuPertama)->get();

            if($id_buku1->all())
            {
                if($id_buku1[0]->qty == 0)
                {    
                    return redirect('/transaction')->with('failed', 'Buku(1) yang dipilih tidak tersedia');
                }
            }
            else
            {
                return redirect('/transaction')->with('failed', 'ID Buku(1) yang dimasukkan tidak ditemukan di sistem');
            }

            // Buku kedua yang dipinjam (Jika ada)
            if($request->jumlahPinjam == 2)
            {
                $id_buku2 = Book::where('id', $request->idBukuKedua)->get();
                
                if($id_buku2->all())
                {
                    if($id_buku2[0]->qty == 0)
                    {
                        return redirect('/transaction')->with('failed', 'Buku(2) yang dipilih tidak tersedia');
                    }
                }
                else 
                {
                    return redirect('/transaction')->with('failed', 'ID Buku(2) yang dimasukkan tidak ditemukan di sistem');
                }
            }

            // Memasukkan Data ke table transactions dan detail_transactions
            $transaction = new Transaction;
            $transaction->member_id = $id[0]->id;
            $transaction->librarian_id = auth()->user()->id;
            $transaction->borrow_date = date('Y-m-d');
            $transaction->save();

            $dicrease_qty = Book::where('id', $request->idBukuPertama)
                                ->update([
                                    'qty' => $id_buku1[0]->qty - 1
                                    ]);

            $id_desc = Transaction::orderByDesc('id')
                                ->limit(1)
                                ->get();

            $detail = new Detail_Transactions;
            $detail->transaction_id = $id_desc[0]->id;
            $detail->book_id = $request->idBukuPertama;
            $detail->date_of_return = date_create('0001-01-01');
            $detail->status = '0';
            $detail->save();

            if($request->jumlahPinjam == 2)
            {
                $id_buku2 = Book::where('id', $request->idBukuKedua)->get();
                
                $dicrease_qty2 = Book::where('id', $request->idBukuKedua)
                                    ->update([
                                        'qty' => $id_buku2[0]->qty - 1
                                        ]);

                $detail = new Detail_Transactions;
                $detail->transaction_id = $id_desc[0]->id;
                $detail->book_id = $request->idBukuKedua;
                $detail->date_of_return = date_create('0001-01-01');
                $detail->status = '0';
                $detail->save();
            }

            return redirect('/transaction')->with('success', 'Peminjaman berhasil dilakukan');
            
        }
        
        return redirect('/transaction')->with('failed', 'Nomor Induk yang dimasukkan tidak ditemukan di sistem');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function search(Request $request)
    {
        $tbl = 'users.'.$request->by;
        $search = '%'.$request->search.'%';

        $datas = Transaction::select('transactions.id', 'users.nomor_induk', 'users.name', DB::raw('COUNT("transaction_id") as sum'))
                            ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('users', 'transactions.member_id', '=', 'users.id')
                            ->where('detail_transactions.status', '0')
                            ->where($tbl, 'like', $search)
                            ->groupBy('transactions.id', 'users.name', 'users.nomor_induk')
                            ->orderBy('transactions.id')
                            ->paginate(3000);

        return view('librarian/data-transaction', compact('datas'));
    }

    public function returnBook(Transaction $transaction)
    {
        $id = $transaction->member_id;
        $data = User::select('nomor_induk', 'name')
                    ->where('id', $id)
                    ->get();
        $book_title = Detail_Transactions::select( 'books.id', 'title')
                                        ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                                        ->where('transaction_id', $transaction->id)
                                        ->where('status', '0')
                                        ->get();
        $count_book = Detail_Transactions::where('transaction_id', $transaction->id)
                                        ->where('status', '0')
                                        ->count();

        return view('librarian/return-book', ['data' => $data[0], 'book_title' => $book_title, 'count_book' => $count_book, 'id_transaction' => $transaction->id]);
    }

    public function returnBookUpdate(Request $request, Transaction $transaction)
    {
        $id_transaksi = $transaction->id;

        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');
        $denda = 0;

        $borrow_date = Transaction::select('borrow_date')
                                    ->where('id', $id_transaksi)
                                    ->get();

        if($request->returnBuku)
        {
            $id_buku = $request->idBuku;

            $change_to_status1 = Detail_Transactions::where('transaction_id', $id_transaksi)
                                                    ->where('book_id', $id_buku)
                                                    ->update([
                                                        'status' => '1',
                                                        'date_of_return' => $today
                                                        ]);

            $qty_book1 = Book::select('qty')
                            ->where('id', $id_buku)
                            ->get();
            
            $increase_qty = Book::where('id', $id_buku)
                                    ->update([
                                        'qty' => $qty_book1[0]->qty + 1
                                        ]);

            $denda += (date_diff(date_create($today), date_create($borrow_date[0]->borrow_date))->format('%a') - 14) * 1000;
        }

        if($request->returnBukuKedua)
        {
            $id_buku2 = $request->idBukuKedua;

            $change_to_status1 = Detail_Transactions::where('transaction_id', $id_transaksi)
                                                    ->where('book_id', $id_buku2)
                                                    ->update([
                                                        'status' => '1',
                                                        'date_of_return' => $today
                                                        ]);

            $qty_book2 = Book::select('qty')
                            ->where('id', $id_buku2)
                            ->get();
            
            $increase_qty2 = Book::where('id', $id_buku2)
                                    ->update([
                                        'qty' => $qty_book2[0]->qty + 1
                                        ]);

            $denda += (date_diff(date_create($today), date_create($borrow_date[0]->borrow_date))->format('%a') - 14) * 1000;

        }
        
        if($request->returnBuku || $request->returnBukuKedua)
        {
            if($denda < 0) $denda=0;
        
            return view('librarian/penalty-page', ["penalty" => $denda, "name" => $request->atasNama, "nomor_induk" => $request->atasNamaNomorInduk]);
        }
        else
        {
            return redirect('/transaction');
        }
    }

    public function checkMember(Request $request)
    {
        $nomor_induk = $request->nomor_induk;

        $name = User::select('name')
                    ->where('nomor_induk', $nomor_induk)
                    ->where('role', "Member")
                    ->get();

        if($name->all()) echo $name[0]->name;
        else echo "Not Found";
    }

    public function checkBook(Request $request)
    {
        $id = $request->id;

        $title = Book::select('title')
                    ->where('id', $id)
                    ->where('qty', '>', 0)
                    ->get();

        if($title->all()) echo $title[0]->title;
        else echo "Not Found";
    }

    public function checkDetail(Request $request)
    {
        $id = $request->id;

        $titles = Detail_Transactions::select('title')
                                    ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                                    ->where('transaction_id', $id)
                                    ->where('status', '0')
                                    ->get();

        $title_response = '';
        foreach($titles as $title)
        {
            $title_response .= $title->title.'~';
        }

        echo $title_response;
    }
}
