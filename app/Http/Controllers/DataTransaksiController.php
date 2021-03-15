<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Detail_Transactions;
use App\Models\User;
use App\Models\Book;
use App\Models\Config;
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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $paginate = Config::all();
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $datas = Transaction::select('transactions.id', 'users.nomor_induk', 'users.name', DB::raw('COUNT("transaction_id") as sum'))
                            ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('users', 'transactions.member_id', '=', 'users.id')
                            ->where('detail_transactions.status', '0')
                            ->groupBy('transactions.id', 'users.name', 'users.nomor_induk')
                            ->orderBy('transactions.id')
                            ->paginate($paginate[0]->transaction_list_page);

        return view('librarian/data-transaction', compact('datas', 'today'));
    }

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
            $transaction = Transaction::create([
                'member_id' => $id[0]->id,
                'borrow_date' => date('Y-m-d'),
            ]);

            $dicrease_qty = Book::where('id', $request->idBukuPertama)
                                ->update([
                                    'qty' => $id_buku1[0]->qty - 1
                                    ]);

            $id_desc = Transaction::orderByDesc('id')
                                ->limit(1)
                                ->get();

            $detail = Detail_Transactions::create([
                'transaction_id' => $id_desc[0]->id,
                'book_id' => $request->idBukuPertama,
                'date_of_return' => date_create('0001-01-01'),
                'status' => '0',
            ]);

            if($request->jumlahPinjam == 2)
            {
                $id_buku2 = Book::where('id', $request->idBukuKedua)->get();
                
                $dicrease_qty2 = Book::where('id', $request->idBukuKedua)
                                    ->update([
                                        'qty' => $id_buku2[0]->qty - 1
                                        ]);

                $detail = Detail_Transactions::create([
                    'transaction_id' => $id_desc[0]->id,
                    'book_id' => $request->idBukuKedua,
                    'date_of_return' => date_create('0001-01-01'),
                    'status' => '0',
                ]);
            }

            return redirect('/transaction')->with('success', 'Peminjaman berhasil dilakukan');
            
        }
        
        return redirect('/transaction')->with('failed', 'Nomor Induk yang dimasukkan tidak ditemukan di sistem');
    }

    public function update(Request $request, Transaction $transaction)
    {
        $id = Detail_Transactions::where('transaction_id', $transaction->id)
                                ->where('status', '0')
                                ->get();

        if($request->idBukuPertamaEdit && $request->idBukuKeduaEdit) {
            if($request->idBukuPertamaEdit == $request->idBukuKeduaEdit) {
                return redirect('/transaction')->with('failed', 'ID Buku Tidak boleh sama');
            }

            if(($request->idBukuPertamaEdit == $id[1]->book_id) && ($id[0]->book_id == $request->idBukuKeduaEdit)) {
                return redirect('/transaction')->with('failed', 'Pengubahan ditolak');
            }
        }

        if($request->idBukuPertamaEdit)
        {
            $check = Book::where('id', $request->idBukuPertamaEdit)->count();
            if($check == 0) return redirect('/transaction')->with('failed', 'ID Buku(1) tidak terdaftar di sistem');

            $checkQTY = Book::where('id', $request->idBukuPertamaEdit)->get();
            if($checkQTY[0]->qty == '0') return redirect('/transaction')->with('failed', 'Buku(1) tidak tersedia');

            $updateID = Detail_Transactions::where('transaction_id', $transaction->id)
                                    ->where('book_id', $id[0]->book_id)
                                    ->update([
                                        'book_id' => $request->idBukuPertamaEdit
                                        ]);

            $qty = Book::select('qty')
                        ->where('id', $request->idBukuPertamaEdit)
                        ->get();
                                    
            $dicrease_qty = Book::where('id', $request->idBukuPertamaEdit)
                                    ->update([
                                        'qty' => $qty[0]->qty - 1
                                        ]);

            $qtyNew = Book::select('qty')
                        ->where('id', $id[0]->book_id)
                        ->get();
                
                                    
            $increase_qty = Book::where('id', $id[0]->book_id)
                                    ->update([
                                        'qty' => $qtyNew[0]->qty + 1
                                        ]);
        }

        if($request->idBukuKeduaEdit)
        {
            $check = Book::where('id', $request->idBukuKeduaEdit)->count();
            if($check == 0) return redirect('/transaction')->with('failed', 'ID Buku(2) tidak terdaftar di sistem');

            $checkQTY = Book::where('id', $request->idBukuKeduaEdit)->get();
            if($checkQTY[0]->qty == '0') return redirect('/transaction')->with('failed', 'Buku(2) tidak tersedia');

            $updateID = Detail_Transactions::where('transaction_id', $transaction->id)
                                    ->where('book_id', $id[1]->book_id)
                                    ->update([
                                        'book_id' => $request->idBukuKeduaEdit
                                        ]);

            $qty = Book::select('qty')
                        ->where('id', $request->idBukuKeduaEdit)
                        ->get();
                        
            $dicrease_qty = Book::where('id', $request->idBukuKeduaEdit)
                                    ->update([
                                        'qty' => $qty[0]->qty - 1
                                        ]);

            $qtyNew = Book::select('qty')
                        ->where('id', $id[1]->book_id)
                        ->get();
                      
            $increase_qty = Book::where('id', $id[1]->book_id)
                                    ->update([
                                        'qty' => $qtyNew[0]->qty + 1
                                        ]);
        }

        return redirect('/transaction')->with('success', 'Data berhasil diubah');
    }

    public function search(Request $request)
    {
        $tbl = 'users.'.$request->by;
        $search = '%'.$request->search.'%';

        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $datas = Transaction::select('transactions.id', 'users.nomor_induk', 'users.name', DB::raw('COUNT("transaction_id") as sum'))
                            ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('users', 'transactions.member_id', '=', 'users.id')
                            ->where('detail_transactions.status', '0')
                            ->where($tbl, 'like', $search)
                            ->groupBy('transactions.id', 'users.name', 'users.nomor_induk')
                            ->orderBy('transactions.id')
                            ->paginate(3000);

        return view('librarian/data-transaction', compact('datas', 'today'));
    }

    public function returnBook(Transaction $transaction)
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

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

        $config = Config::all();

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

            $denda += (date_diff(date_create($today), date_create($borrow_date[0]->borrow_date))->format('%a') - $config[0]->loan_deadline) * $config[0]->late_charge;
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

            $denda += (date_diff(date_create($today), date_create($borrow_date[0]->borrow_date))->format('%a') - $config[0]->loan_deadline) * $config[0]->late_charge;

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

    public function checkDetailEdit(Request $request)
    {
        $id = $request->id;

        $titles = Detail_Transactions::select('id', 'title')
                                    ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                                    ->where('transaction_id', $id)
                                    ->where('status', '0')
                                    ->get();

        $count = Detail_Transactions::join('books', 'books.id', '=', 'detail_transactions.book_id')
                                    ->where('transaction_id', $id)
                                    ->where('status', '0')
                                    ->count();

        $title_response = $count.'~';
        foreach($titles as $title)
        {
            $title_response .= $title->id.'~';
            $title_response .= $title->title.'~';
        }

        echo $title_response;
    }

    public function lateTransaction()
    {
        $config = Config::all();

        $datas = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('users', 'users.id', '=', 'transactions.member_id')
                            ->join('members', 'members.id', '=', 'users.id')
                            ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                            ->select('transactions.id', 'transactions.borrow_date', 'transactions.member_id', 'users.nomor_induk', 'users.name', 'users.email', 'members.class', 'books.title', 'detail_transactions.last_warned', DB::raw('DATE_ADD(transactions.borrow_date, INTERVAL '.$config[0]->loan_deadline.' DAY) as back'))
                            ->where('detail_transactions.status', '0')
                            ->get();

        $string_datas = '';
        foreach ($datas as $data) {
            $string_datas .= $data->id.'~';
            $string_datas .= $data->borrow_date.'~';
            $string_datas .= $data->member_id.'~';
            $string_datas .= $data->nomor_induk.'~';
            $string_datas .= $data->name.'~';

            if($data->class == null) $string_datas .= '-~';
            else $string_datas .= $data->class.'~';
            
            $string_datas .= $data->title.'~';
            $string_datas .= $data->back.'~';
            $string_datas .= $data->last_warned.'~';
        }
        echo $string_datas;
    }
}
