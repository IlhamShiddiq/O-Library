<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;
use App\Models\Librarian;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcoming;

class ConfirmPageController extends Controller
{
    public function confirmPage()
    {
        return view('confirm-page/confirm-page');
    }

    public function confirmPageData(Request $request)
    {
        $validateData = $request->validate([
            'nomorInduk' => 'required',
            'kodeKonfirmasi' => 'required'
        ]);

        $nomor_induk = User::where('nomor_induk', $request->nomorInduk)
                        ->get();

        // dd($code->all()[0]->nomor_induk);
        if($nomor_induk->all())
        {
            $id = $nomor_induk[0]->id;

            $role = User::select('role')
                        ->where('id', $id)
                        ->get();

            if($role[0]->role == 'Pustakawan' || $role[0]->role == 'Admin')
            {
                $code = Librarian::where('confirm_code', $request->kodeKonfirmasi)
                                    ->where('id', $id)
                                    ->get();

                if ($code->all())
                {
                    return view('confirm-page.confirming-page', compact('id'));
                }
                else
                {
                    return redirect('/account/confirm')->with('status', 'Kode Konfirmasi tidak terdaftar di sistem');
                }
            }
            else {
                $code = Member::where('confirm_code', $request->kodeKonfirmasi)
                                    ->where('id', $id)
                                    ->get();

                if ($code->all())
                {
                    return view('confirm-page.confirming-page', compact('id'));
                }
                else
                {
                    return redirect('/account/confirm')->with('status', 'Kode Konfirmasi tidak terdaftar di sistem');
                }
            }
        }
        else {
            return redirect('/account/confirm')->with('status', 'Nomor induk tidak terdaftar di sistem');
        }
    }


    public function confirmingPageData(Request $request, User $user)
    {
        if(strlen($request->username) < 5) {
            return redirect('/account/confirm')->with('status', 'Minimal username terdiri atas 5 karakter angka/huruf');
        }
        else if(strlen($request->password) < 8) {
            return redirect('/account/confirm')->with('status', 'Minimal password terdiri atas 8 karakter angka/huruf');
        }

        $username = User::where('username', $request->username)
                        ->get();

        if (!$username->all())
        {
            if($request->password == $request->confirmPassword)
            {
                User::where('id', $user->id)
                    ->update([
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                        ]);

                if($user->role == 'Pustakawan' || $user->role == 'Admin')
                {
                    Librarian::where('id', $user->id)
                    ->update([
                        'confirm_code' => null
                        ]);
                }
                else{
                    Member::where('id', $user->id)
                    ->update([
                        'confirm_code' => null
                        ]);
                }

//                Mail::to($user->email, $user->name)->send(new Welcoming($user));

                return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan untuk login kembali.');
            }
            else{
                return redirect('/account/confirm/')->with('status', 'Password tidak cocok saat dikonfirmasi');
            }
        }
        else
        {
            return redirect('/account/confirm/')->with('status', 'Username telah dipakai oleh user lain');
        }
    }
}
