<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
use App\Models\Detail_Transactions;
use App\Models\User;

class SendReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $user = User::where('id', $this->transaction->member_id)->get();
        $detail = Detail_Transactions::select('title')
                                    ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                                    ->where('transaction_id', $this->transaction->id)
                                    ->where('status', '0')
                                    ->get();

        $books = '';
        for($i=0; $i<count($detail); $i++)
        {
            $books .= $detail[$i]->title.', ';
        }

        return $this->from('perpustakaansmkn01@gmail.com', 'Perpustakaan SMKN 1 Cimahi')
                   ->view('mail/reminder')
                   ->subject('Peringatan')
                   ->with([
                        'head' => 'Peringatan!',
                        'sub' => 'Kepada '.$user[0]->name.' ('.$user[0]->nomor_induk.')',
                        'pesan' => 'Batas peminjaman buku anda telah melampaui batas. Buku dengan judul '.$books.'belum dikembalikan. Hubungi segera pihak perpustakaan atau kunjungi langsung ke tempat jika terdapat kendala.',
                        'pustakawan' => auth()->user()->name
                    ]);
    }
}
