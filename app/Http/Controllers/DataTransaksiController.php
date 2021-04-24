<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Detail_Transactions;
use App\Models\User;
use App\Models\Book;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cookie;

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

    public function create()
    {
        $lists = [];
        $books = json_decode(request()->cookie('add-book-lists'), true);
        $member = json_decode(request()->cookie('member-list'), true);
        
        if(!$books) array_push($lists, ['picture' => '-', 'title' => '-']);
        else $lists = $books;

        return view('librarian.add-transaction', compact('lists', 'member'));
    }

    public function createBook(Request $request)
    {
        $isbn = chop($request->isbn, 'e');
        $book_data = Book::where('isbn', $isbn)->get();
        if(count($book_data) == 0) return redirect('/transaction/add')->with('failed', 'Buku tidak terdaftar di sistem');

        $lists = [];
        $books = json_decode(request()->cookie('add-book-lists'), true);

        if($books) {
            if(isset($books[1]['id'])) return redirect('/transaction/add')->with('failed', 'Peminjaman tak boleh lebih dari 2 buku');

            if($book_data[0]->id == $books[0]['id']) return redirect('/transaction/add')->with('failed', 'Buku ini telah ditambahkan sebelumnya');

            array_push($lists, [
                'id' => $books[0]['id'],
                'picture' => $books[0]['picture'],
                'title' => $books[0]['title'],
                'status' => $books[0]['status']
            ]);
        }

        array_push($lists, [
                        'id' => $book_data[0]->id,
                        'picture' => $book_data[0]->image,
                        'title' => $book_data[0]->title,
                        'status' => 'added'
                    ]);

        $cookie = cookie('add-book-lists', json_encode($lists), 60);

        return redirect('/transaction/add')->cookie($cookie);
    }

    public function createMember(Request $request)
    {
        $nomor_induk = $request->nomorIndukMember;
        $datas = User::where('nomor_induk', $nomor_induk)->get();
        if(count($datas) == 0) return redirect('/transaction')->with('failed', 'Anggota tidak terdaftar di sistem');
        if($datas[0]->role != 'Member') return redirect('/transaction')->with('failed', 'User ini tidak terdaftar sebagai anggota');

        $data = [
            'nomor_induk' => $nomor_induk,
            'name' => $datas[0]->name
        ];

        $cookie = cookie('member-list', json_encode($data), 60);

        return redirect('/transaction/add')->cookie($cookie);
    }

    public function reset() {
        return redirect('/transaction/add')->withCookie(Cookie::forget('add-book-lists'));
    }

    public function cancel() {
        return redirect('/transaction')->with('success', 'Peminjaman dibatalkan')->withCookie(Cookie::forget('add-book-lists'))->withCookie(Cookie::forget('member-list'));
    }

    public function store(Request $request)
    {
        $books = json_decode(request()->cookie('add-book-lists'), true);
        $member = json_decode(request()->cookie('member-list'), true);
        if(!$member) return redirect('/transaction/add')->with('failed', 'Member yang meminjam belum ditambahkan');
        if(!$books) return redirect('/transaction/add')->with('failed', 'Buku yang dipinjam belum ditambahkan');
        
        $idBukuPertama = $books[0]['id'];
        $idBukuKedua = 0;
        $nomor_induk = $member['nomor_induk'];
        
        $jumlahPinjam = count($books);
        
        if ($jumlahPinjam == 2)
        {
            $idBukuKedua = $books[1]['id'];
        }
        
        // Ambil id dari nomor induk yang ditambah
        $id = User::select('id')
        ->where('nomor_induk', $nomor_induk)
        ->where('role', 'Member')
        ->get();
        
        // Mengecek apakah member ini sebelumnya pernah meminjam dan belum dikembalikan
        $transaction_id = Transaction::where('member_id', $id[0]->id)
                                        ->orderByDesc('id')
                                        ->limit(1)
                                        ->get();

        if(count($transaction_id) != 0) {
            $checkMember = Detail_Transactions::where('transaction_id', $transaction_id[0]->id)
                                            ->where('status', '0')
                                            ->get();

            if(count($checkMember) != 0) return redirect('/transaction/add')->with('failed', 'Member ini sebelumnya telah meminjam dan belum mengembalikan buku tersebut');
        }                                 

        // Buku pertama yang dipinjam
        $id_buku1 = Book::where('id', $idBukuPertama)->get();

        if($id_buku1[0]->qty == 0)
        {    
            return redirect('/transaction/add')->with('failed', 'Buku(1) yang dipilih tidak tersedia');
        }

        // Buku kedua yang dipinjam (Jika ada)
        if($jumlahPinjam == 2)
        {
            $id_buku2 = Book::where('id', $idBukuKedua)->get();
            
            if($id_buku2[0]->qty == 0)
            {
                return redirect('/transaction/add')->with('failed', 'Buku(2) yang dipilih tidak tersedia');
            }
        }

        // Memasukkan Data ke table transactions dan detail_transactions
        $transaction = Transaction::create([
            'member_id' => $id[0]->id,
            'borrow_date' => date('Y-m-d'),
        ]);

        $dicrease_qty = Book::where('id', $idBukuPertama)
                            ->update([
                                'qty' => $id_buku1[0]->qty - 1
                                ]);

        $id_desc = Transaction::orderByDesc('id')
                            ->limit(1)
                            ->get();

        $detail = Detail_Transactions::create([
            'transaction_id' => $id_desc[0]->id,
            'book_id' => $idBukuPertama,
            'date_of_return' => date_create('0001-01-01'),
            'status' => '0',
        ]);

        if($jumlahPinjam == 2)
        {
            $id_buku2 = Book::where('id', $idBukuKedua)->get();
            
            $dicrease_qty2 = Book::where('id', $idBukuKedua)
                                ->update([
                                    'qty' => $id_buku2[0]->qty - 1
                                    ]);

            $detail = Detail_Transactions::create([
                'transaction_id' => $id_desc[0]->id,
                'book_id' => $idBukuKedua,
                'date_of_return' => date_create('0001-01-01'),
                'status' => '0',
            ]);
        }

        return redirect('/transaction')->with('success', 'Peminjaman berhasil dilakukan')->withCookie(Cookie::forget('add-book-lists'))->withCookie(Cookie::forget('member-list'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $idPertama = null;
        $idKedua = null;
        
        $id = Detail_Transactions::where('transaction_id', $transaction->id)
                                ->where('status', '0')
                                ->get();

        if($request->isbnPertama) {
            $isbnPertama = $request->isbnPertama;
            $isbnPertama = chop($request->isbnPertama, 'e');
            $book_id = Book::where('isbn', $isbnPertama)->get();

            if(count($book_id) == 0) return redirect('/transaction')->with('failed', 'ID Buku(1) tidak terdaftar di sistem');
            if($book_id[0]->qty == '0') return redirect('/transaction')->with('failed', 'Buku(1) tidak tersedia');

            $idPertama = $book_id[0]->id;
        }

        if($request->isbnPertama && $request->isbnKedua) {
            $isbnKedua = $request->isbnKedua;
            $isbnKedua = chop($request->isbnKedua, 'e');
            $book_id_2 = Book::where('isbn', $isbnKedua)->get();

            if(count($book_id_2) == 0) return redirect('/transaction')->with('failed', 'ID Buku(2) tidak terdaftar di sistem');
            if($book_id_2[0]->qty == '0') return redirect('/transaction')->with('failed', 'Buku(2) tidak tersedia');

            $idKedua = $book_id_2[0]->id;

            if($idPertama == $idKedua) {
                return redirect('/transaction')->with('failed', 'ID Buku Tidak boleh sama');
            }

            if(($idPertama == $id[1]->book_id) && ($id[0]->book_id == $idKedua)) {
                return redirect('/transaction')->with('failed', 'Pengubahan ditolak');
            }
        }

        if($idPertama)
        {
            $updateID = Detail_Transactions::where('transaction_id', $transaction->id)
                                    ->where('book_id', $id[0]->book_id)
                                    ->update([
                                        'book_id' => $idPertama
                                        ]);

            $qty = Book::select('qty')
                        ->where('id', $idPertama)
                        ->get();
                                    
            $dicrease_qty = Book::where('id', $idPertama)
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

        if($idKedua)
        {
            $updateID = Detail_Transactions::where('transaction_id', $transaction->id)
                                    ->where('book_id', $id[1]->book_id)
                                    ->update([
                                        'book_id' => $idKedua
                                        ]);

            $qty = Book::select('qty')
                        ->where('id', $idKedua)
                        ->get();
                        
            $dicrease_qty = Book::where('id', $idKedua)
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
        $isbn = $request->isbn;

        $title = Book::select('title')
                    ->where('isbn', $isbn)
                    ->where('qty', '>', 0)
                    ->get();

        if($title->all()) echo $title[0]->title;
        else echo "Not Found";
    }

    public function checkBookTransaction(Request $request)
    {
        $isbn = $request->isbn;

        $datas = Book::join('publishers', 'publishers.id', '=', 'books.publisher_id')
                    ->select('books.title', 'publishers.publisher', 'books.author')
                    ->where('books.isbn', $isbn)
                    ->get();

        if($datas->all()) echo $datas[0]->title.'~'.$datas[0]->author.'~'.$datas[0]->publisher;
        else echo "Not Found~Not Found~Not Found";
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

        $titles = Detail_Transactions::select('isbn', 'id', 'title')
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
            $title_response .= $title->isbn.'~';
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
