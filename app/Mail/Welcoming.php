<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class Welcoming extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('perpustakaansmkn01@gmail.com', 'Perpustakaan SMKN 1 Cimahi')
                   ->view('mail/welcoming')
                   ->subject('Selamat Datang')
                   ->with([
                        'head' => 'Selamat Satang di Perpustakaan SMKN 1 Cimahi',
                        'sub' => 'Kepada '.$this->user->name.' ('.$this->user->nomor_induk.')',
                        'pesan' => 'Selamat datang, sekarang anda telah resmi menjadi '.$this->user->role.' perpustakaan. Beberapa informasi lebih lanjut dapat anda temukan di web perpustakaan SMKN 1 Cimahi.',
                        'pustakawan' => 'Salam'
                    ]);
    }
}
