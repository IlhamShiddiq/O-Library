<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UsingEbook extends Mailable
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
                   ->view('templates/mail')
                   ->subject('Pemberitahuan')
                   ->with([
                        'head' => 'Pengajuan Ebook',
                        'sub' => 'Kepada '.$this->user->name.' ('.$this->user->nomor_induk.')',
                        'pesan' => 'Halo, anda telah mengajukan penggunaan ebook, pengajuan anda akan kami tanggapi paling lama 1x24 jam. Mohon tunggu sampai adanya tindakan untuk pengajuan anda.',
                        'pustakawan' => 'Salam'
                    ]);
    }
}
