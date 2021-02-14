<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use App\Models\User;
use App\Mail\SendReminder;

class SendEmailController extends Controller
{
    public function sendReminder(Transaction $transaction)
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $id = $transaction->id;
        
        $user = User::select('email', 'name')
                    ->where('id', $transaction->member_id)
                    ->get();
        
        Mail::to($user[0]->email, $user[0]->name)->send(new SendReminder($transaction));

        return redirect('/transaction')->with('success', 'Email berhasil terkirim kepada '.$user[0]->name);
    }
}
