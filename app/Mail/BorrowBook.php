<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Detail_Transactions;

class BorrowBook extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction)
    {
        $this->user = $user;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $detail = Detail_Transactions::select('title')
                                    ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                                    ->where('transaction_id', $this->transaction->id)
                                    ->get();

        $books = '';
        for($i=0; $i<count($detail); $i++)
        {
            $books .= $detail[$i]->title.', ';
        }
        
        return $this->from('perpustakaansmkn01@gmail.com', 'Perpustakaan SMKN 1 Cimahi')
                   ->view('templates/mail')
                   ->subject('Pemberitahuan')
                   ->with([
                        'head' => 'Peminjaman Buku',
                        'sub' => 'Kepada '.$this->user->name.' ('.$this->user->nomor_induk.')',
                        'pesan' => 'Halo, anda telah meminjam '.count($detail).' buku dari perpustakaan dengan judul '.$books.' jaga buku tersebut baik-baik layaknya menyayangi barang paling disukai dan jangan lupa untuk mengembalikannya dengan tepat waktu.',
                        'pustakawan' => auth()->user()->name
                    ]);
    }
}
