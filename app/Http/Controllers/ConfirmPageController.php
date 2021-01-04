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
                    return redirect('/account/confirming/'.$id);
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
                    return redirect('/account/confirming/'.$id);
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

    public function confirmingPage(User $user)
    {
        $id = $user->id;

        return view('confirm-page.confirming-page', compact('id'));
    }

    public function confirmingPageData(Request $request, User $user)
    {
        $validateData = $request->validate([
            'username' => 'required|min:5',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|min:8',
        ]);

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
                
                Mail::to($user->email, $user->name)->send(new Welcoming($user));

                return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan untuk login kembali.');
            }
            else{
                return redirect('/account/confirming/'.$user->id)->with('status', 'Password tidak cocok saat dikonfirmasi');
            }
        }
        else
        {
            return redirect('/account/confirming/'.$user->id)->with('status', 'Username telah dipakai oleh user lain');
        }
    }
}
