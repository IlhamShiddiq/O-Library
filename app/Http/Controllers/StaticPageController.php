<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use PDF;

class StaticPageController extends Controller
{
    public function guide()
    {
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        return view('librarian/guide');
    }

    public function selecting()
    {
        $role = auth()->user()->role;
        if($role == 'Pustakawan' || $role == 'Admin')
        {
            return redirect('/dashboard')->with('success', 'Selamat Datang '.auth()->user()->name);
        }
        else
        {
            return redirect('/member/dashboard')->with('success', 'Selamat Datang '.auth()->user()->name);
        }
    }

    public function pdfReport()
    {
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        date_default_timezone_set('Asia/Jakarta');

        $message = '-';

        $this_month = date('n');
        $borrow_teacher = Transaction::join('users', 'transactions.member_id', '=', 'users.id')
                                    ->join('members', 'members.id', '=','users.id')
                                    ->where('members.status', 'Guru')
                                    ->whereMonth('transactions.borrow_date', $this_month)
                                    ->count();
        $borrow_student = Transaction::join('users', 'transactions.member_id', '=', 'users.id')
                                    ->join('members', 'members.id', '=','users.id')
                                    ->where('members.status', 'Siswa')
                                    ->whereMonth('transactions.borrow_date', $this_month)
                                    ->count();
        $return_on_time = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                    ->where(DB::raw('DATEDIFF(date_of_return, borrow_date)'), '<', '14')
                                    ->whereMonth('detail_transactions.date_of_return', $this_month)
                                    ->count();
        $return_late = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                    ->where(DB::raw('DATEDIFF(date_of_return, borrow_date)'), '>', '14')
                                    ->whereMonth('detail_transactions.date_of_return', $this_month)
                                    ->count();
        $accepted_request = Permission::where('confirmed', 1)
                                    ->where('accepted', 1)
                                    ->whereMonth('submit_date', $this_month)
                                    ->count();
        $refused_request = Permission::where('confirmed', 1)
                                    ->where('accepted', 0)
                                    ->whereMonth('submit_date', $this_month)
                                    ->count();

        return view('report/report-pdf', compact('borrow_teacher', 'borrow_student', 'return_on_time', 'return_late', 'accepted_request', 'refused_request', 'message'));
    }

    public function pdfReportPrint()
    {
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }
        
        date_default_timezone_set('Asia/Jakarta');

        $message = '-';

        $this_month = date('n');
        $this_month_name = date('F Y');
        $borrow_teacher = Transaction::join('users', 'transactions.member_id', '=', 'users.id')
                                    ->join('members', 'members.id', '=','users.id')
                                    ->where('members.status', 'Guru')
                                    ->whereMonth('transactions.borrow_date', $this_month)
                                    ->count();
        $borrow_student = Transaction::join('users', 'transactions.member_id', '=', 'users.id')
                                    ->join('members', 'members.id', '=','users.id')
                                    ->where('members.status', 'Siswa')
                                    ->whereMonth('transactions.borrow_date', $this_month)
                                    ->count();
        $return_on_time = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                    ->where(DB::raw('DATEDIFF(date_of_return, borrow_date)'), '<', '14')
                                    ->whereMonth('detail_transactions.date_of_return', $this_month)
                                    ->count();
        $return_late = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                    ->where(DB::raw('DATEDIFF(date_of_return, borrow_date)'), '>', '14')
                                    ->whereMonth('detail_transactions.date_of_return', $this_month)
                                    ->count();
        $accepted_request = Permission::where('confirmed', 1)
                                    ->where('accepted', 1)
                                    ->whereMonth('submit_date', $this_month)
                                    ->count();
        $refused_request = Permission::where('confirmed', 1)
                                    ->where('accepted', 0)
                                    ->whereMonth('submit_date', $this_month)
                                    ->count();

        $pdf = PDF::loadView('report/report', compact('borrow_teacher', 'borrow_student', 'return_on_time', 'return_late', 'accepted_request', 'refused_request', 'message'));
        return $pdf->download($this_month_name.' Report');
    }

    public function excelReportMessage(Request $request)
    {
        if($request->queue == null) return redirect('/report')->with('success', 'Tidak ada data yang dapat dieksport menjadi file excel');
        $lists = '';
        foreach($request->queue as $entry) {
            $lists .= $entry.'~';
        }
        return Excel::download(new ReportExport($lists), 'report.xlsx');
    }

    public function cardMember(Request $request) {
        $validateData = $request->validate([
            'nomor_induk' => 'required'
        ]);

        $data = User::where('nomor_induk', $request->nomor_induk)
                    ->where('role', 'Member')
                    ->first();

        if($data) {
            return view('member-card/card', compact('data'));
        } else {
            return redirect('/member')->with('failed', 'Anggota tidak ditemukan');
        }
    }

    public function printCard(User $user) {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $pdf = PDF::loadView('member-card.card-member', compact('user'));
        return $pdf->download($user->nomor_induk.'-'.$user->name);
    }

    public function aboutDev() {
        return view('about-dev');
    }

    public function a() {
        return view('mail.verification', ['verification_code' => 'a', 'head' => 'a', 'sub' => 'b', 'pesan' => 'c', 'pustakawan' => 'd']);
    }
}
