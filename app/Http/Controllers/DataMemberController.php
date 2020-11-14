<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
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

            return redirect('/member')->with('success', 'Kode berhasil direset \n Kode : '.$request->kodeKonfirmasiReset);
        }
    }
}
