<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerification;
use App\Mail\ResendVerification;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class DataMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $paginate = Config::all();
        $isSearch = '';

        $members = DB::table('users')
            ->join('members', 'users.id', '=', 'members.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'members.address', 'members.phone', 'members.status', 'members.class', 'members.confirm_code')
            ->paginate($paginate[0]->member_list_page);

        $count = DB::table('users')
            ->join('members', 'users.id', '=', 'members.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'members.address', 'members.phone', 'members.status', 'members.class', 'members.confirm_code')
            ->count();

        return view('librarian.data-member', compact('members', 'count', 'isSearch'));
    }

    public function memberDetail(Member $member)
    {
        $datas = Member::join('users', 'users.id', '=', 'members.id')
                        ->select('users.*', 'members.address', 'members.phone', 'members.status', 'members.class')
                        ->where('members.id', $member->id)
                        ->get();

        return view('librarian.detail-member', ['data' => $datas[0]])
;    }

    public function memberHistory(Member $member)
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $histories = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                                ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                                ->where('member_id', $member->id)
                                ->get();

        $count = Transaction::join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                            ->join('books', 'books.id', '=', 'detail_transactions.book_id')
                            ->where('member_id', $member->id)
                            ->count();

        return view('librarian/data-member-history', compact('histories', 'count'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nomorInduk' => 'required',
            'namaLengkap' => 'required',
            'telpAnggota' => 'required',
            'emailAnggota' => 'required',
            'alamatAnggota' => 'required',
            'photoAnggota' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $code_generate = '';
        for($i=0; $i<6; $i++){
            $code_generate .= rand(0, 9);
        }

        $code = Member::where('confirm_code', $code_generate)->get();
        // dd($code->all());

        if($code->all()) return redirect('/member')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else
        {

            $file = $request->file('photoAnggota');

            if($file) $image = $request->nomorInduk.'/'.$file->getClientOriginalName();
            else $image = "default.jpg";

            $user = User::create([
                'nomor_induk' => $request->nomorInduk,
                'name' => $request->namaLengkap,
                'role' => 'Member',
                'email' => $request->emailAnggota,
                'remember_token' => Str::random(30),
                'profile_photo_path' => $image,
            ]);

            if($request->roleAnggota == 'Siswa') $class = $request->tingkatAnggota.'-'.$request->jurusanAnggota.'-'.$request->kelasAnggota;
            else $class = '';

            $mem = Member::create([
                'id' => $user->id,
                'address' => $request->alamatAnggota,
                'phone' => $request->telpAnggota,
                'status' => $request->roleAnggota,
                'class' => $class,
                'confirm_code' => $code_generate,
            ]);

            if($file) $file->move(public_path('uploaded_files/member-foto/'.$request->nomorInduk.'/'),$file->getClientOriginalName());

//            Mail::to($user->email, $user->name)->send(new SendVerification($user));

            return redirect('/member')->with('success', 'Data '.$request->namaLengkap.' berhasil disimpan dan kode verifikasi telah berhasil terkirim');
        }
    }

    public function edit(Member $member)
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $id = auth()->user()->id;
        $datas = DB::table('users')
                    ->join('members', 'users.id', '=', 'members.id')
                    ->select('users.id', 'users.name', 'users.email', 'users.username', 'users.profile_photo_path', 'users.role', 'members.*')
                    ->where('users.id', $id)
                    ->get();

        return view('member/edit-profile', compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = auth()->user()->id;

        $users = DB::table('users')
                    ->join('members', 'users.id', '=', 'members.id')
                    ->select('nomor_induk', 'members.id', 'users.profile_photo_path')
                    ->where('members.id', $id)
                    ->get();

        $validateData = $request->validate([
            'namaMember' => 'required',
            'nomorTelepon' => 'required',
            'emailMember' => 'required',
            'alamatMember' => 'required',
            'photoMember' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $file = $request->file('photoMember');

        if($file) $foto = $users[0]->nomor_induk.'/'.$file->getClientOriginalName();
        else $foto = $users[0]->profile_photo_path;

        Member::where('id', $id)
                    ->update([
                        'phone' => $request->nomorTelepon,
                        'address' => $request->alamatMember,
                        ]);

        User::where('id', $id)
                    ->update([
                        'name' => $request->namaMember,
                        'email' => $request->emailMember,
                        'profile_photo_path' => $foto
                        ]);

        if($file) {
            if($users[0]->profile_photo_path != "default.jpg") File::delete(public_path('uploaded_files/member-foto/'.$users[0]->profile_photo_path));
            $file->move(public_path('uploaded_files/member-foto/'.$users[0]->nomor_induk),$file->getClientOriginalName());
        }

        return redirect('/member/edit-profile')->with('success', 'Data Profile berhasil diubah');
    }

    public function editPass()
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $id = auth()->user()->id;
        $users = DB::table('users')
                    ->select('users.id', 'users.username')
                    ->where('users.id', $id)
                    ->get();

        return view('member/change-password', compact('users'));
    }

    public function updatePass(Request $request)
    {
        $id = auth()->user()->id;

        $validateData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8',
            'checkboxConfirm' => 'required',
        ]);

        $checkMatches = Hash::check($request->get('oldPassword'), Auth::user()->password);

        if(!($checkMatches))
        {
            return redirect('/member/change-password')->with('failed', 'Password yang anda masukkan salah');
        }

        if(!($request->newPassword == $request->confirmPassword))
        {
            return redirect('/member/change-password')->with('failed', 'Password baru tidak cocok saat dikonfirmasi');
        }

        $newPass = bcrypt($request->newPassword);
        User::where('id', $id)
                    ->update([
                        'password' => $newPass,
                        ]);

        return redirect('/member/change-password')->with('success', 'Password berhasil diganti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $member)
    {
        Member::destroy($member->id);
        User::destroy($member->id);
        if($member->profile_photo_path) {
            if($member->profile_photo_path != "default.jpg") File::deleteDirectory(public_path('uploaded_files/member-foto/'.$member->nomor_induk));
        }

        return redirect('/member')->with('success', 'Data '.$member->name.' berhasil dihapus');
    }

    public function search(Request $request)
    {
        if($request->by == 'name') $tbl = 'users.'.$request->by;
        else $tbl = 'members.'.$request->by;

        $search = '%'.$request->search.'%';
        $isSearch = 'display: none';

        $members = DB::table('users')
            ->join('members', 'users.id', '=', 'members.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'members.address', 'members.phone', 'members.status', 'members.class', 'members.confirm_code')
            ->where($tbl, 'like', $search)
            ->paginate(3000);

        $count = DB::table('users')
            ->join('members', 'users.id', '=', 'members.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'members.address', 'members.phone', 'members.status', 'members.class', 'members.confirm_code')
            ->where($tbl, 'like', $search)
            ->count();

        return view('librarian.data-member', compact('members', 'count', 'isSearch'));
    }

    public function resetCode(Request $request, Member $member)
    {
        $code_generate = '';
        for($i=0; $i<6; $i++){
            $code_generate .= rand(0, 9);
        }

        $code = Member::where('confirm_code', $code_generate)->get();

        if($code->all()) return redirect('/member')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else {
            Member::where('id', $member->id)
                    ->update([
                        'confirm_code' => $code_generate,
                        ]);

            $user = User::find($member->id);
//            Mail::to($user->email, $user->name)->send(new ResendVerification($user));

            return redirect('/member')->with('success', 'Kode berhasil direset. Kode telah dikirim ke email pengguna');
        }
    }

    public function importMember(Request $request) {
        $validateData = $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new MemberImport, $request->file);

        return redirect('/member')->with('success', 'Data berhasil ditambah');
    }
}
