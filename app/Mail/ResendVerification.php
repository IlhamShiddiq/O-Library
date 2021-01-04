<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;
use App\Models\Librarian;
use App\Models\User;

class ResendVerification extends Mailable
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
        if($this->user->role == 'Member') $code = Member::find($this->user->id);
        else $code = Librarian::find($this->user->id);

        return $this->from('perpustakaansmkn01@gmail.com', 'Perpustakaan SMKN 1 Cimahi')
                   ->view('mail/verification')
                   ->subject('Kode Verifikasi')
                   ->with([
                        'head' => 'Selamat Satang di Perpustakaan SMKN 1 Cimahi',
                        'sub' => 'Kepada '.$this->user->name.' ('.$this->user->nomor_induk.')',
                        'pesan' => 'Kode anda telah direset. Ini adalah tahap terakhir sebelum anda dapat login ke web perpustakaan. Verifikasi akun anda untuk membuat username dan password anda sendiri. Masukkan kode berikut ke halaman konfirmasi akun.',
                        'verification_code' => $code->confirm_code,
                        'pustakawan' => auth()->user()->name
                    ]);
    }
}
