<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 
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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $members = DB::table('users')
            ->join('members', 'users.id', '=', 'members.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'members.address', 'members.phone', 'members.status', 'members.class', 'members.confirm_code')
            ->paginate(5);

        $count = DB::table('users')
            ->join('members', 'users.id', '=', 'members.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'members.address', 'members.phone', 'members.status', 'members.class', 'members.confirm_code')
            ->count();

        return view('librarian.data-member', compact('members', 'count'));
    }

    public function memberHistory()
    {
        return view('librarian/data-member-history');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nomorInduk' => 'required',
            'namaLengkap' => 'required',
            'telpAnggota' => 'required',
            'emailAnggota' => 'required',
            'alamatAnggota' => 'required',
            'kodeKonfirmasi' => 'required',
            'photoAnggota' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $code = Member::where('confirm_code', $request->kodeKonfirmasi)->get();
        // dd($code->all());

        if($code->all()) return redirect('/member')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else
        {
            $file = $request->file('photoAnggota');

            if($file) $image = $file->getClientOriginalName();
            else $image = "default.jpg";

            $user = new User;
            $user->nomor_induk = $request->nomorInduk;
            $user->name = $request->namaLengkap;
            $user->role = 'Member';
            $user->email = $request->emailAnggota;
            $user->remember_token = Str::random(30);
            $user->profile_photo_path = $image;
            $user->save();

            $lastid = DB::table('users')
                ->select('id')
                ->orderByDesc('id')
                ->limit(1)
                ->get();

            if($request->roleAnggota == 'Siswa') $class = $request->tingkatAnggota.'-'.$request->jurusanAnggota.'-'.$request->kelasAnggota;
            else $class = '';

            $mem = new Member;
            $mem->id = $lastid[0]->id;
            $mem->address = $request->alamatAnggota;
            $mem->phone = $request->telpAnggota;
            $mem->status = $request->roleAnggota;
            $mem->class = $class;
            $mem->confirm_code = $request->kodeKonfirmasi;
            $mem->save();

            if($file) $file->move(public_path('uploaded_files/member-foto/'),$file->getClientOriginalName());

            return redirect('/member')->with('success', 'Data '.$request->namaLengkap.' berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
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
                    ->select('members.id', 'users.profile_photo_path')
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

        if($file) $foto = $file->getClientOriginalName();
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
            $file->move(public_path('uploaded_files/member-foto/'),$file->getClientOriginalName());
        }
        
        return redirect('/member/edit-profile')->with('success', 'Data Profile berhasil diubah');
    }
        
    public function editPass()
    {
        if(!(auth()->user()->role == 'Member'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
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
            if($member->profile_photo_path != "default.jpg") File::delete(public_path('uploaded_files/member-foto/'.$member->profile_photo_path));
        }

        return redirect('/member')->with('success', 'Data '.$member->name.' berhasil dihapus');
    }

    public function search(Request $request)
    {
        if($request->by == 'name') $tbl = 'users.'.$request->by;
        else $tbl = 'members.'.$request->by;

        $search = '%'.$request->search.'%';

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

        return view('librarian.data-member', compact('members', 'count'));
    }

    public function resetCode(Request $request, Member $member)
    {
        // dd($member->id);
        $validateData = $request->validate([
            'kodeKonfirmasiReset' => 'required',
        ]);

        $code = Member::where('confirm_code', $request->kodeKonfirmasiReset)->get();

        if($code->all()) return redirect('/member')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else {
            Member::where('id', $member->id)
                    ->update([
                        'confirm_code' => $request->kodeKonfirmasiReset,
                        ]);

            return redirect('/member')->with('success', 'Kode berhasil direset. Kode : '.$request->kodeKonfirmasiReset);
        }
    }
}
