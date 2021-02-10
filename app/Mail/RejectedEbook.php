<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Permission;
use App\Models\Ebook;

class RejectedEbook extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Permission $permission)
    {
        $this->user = $user;
        $this->permission = $permission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ebook = Ebook::find($this->permission->id_ebook);
        return $this->from('perpustakaansmkn01@gmail.com', 'Perpustakaan SMKN 1 Cimahi')
                   ->view('templates/mail')
                   ->subject('Pemberitahuan')
                   ->with([
                        'head' => 'Pengajuan telah ditolak',
                        'sub' => 'Kepada '.$this->user->name.' ('.$this->user->nomor_induk.')',
                        'pesan' => 'Halo, pengajuan ebook anda dengan judul '.$ebook->title.' telah ditolak, buka kembali halaman daftar pengajuan anda dan cari tahu mengapa pengajuan ini ditolak. Terima kasih.',
                        'pustakawan' => 'Salam'
                    ]);
    }
}
