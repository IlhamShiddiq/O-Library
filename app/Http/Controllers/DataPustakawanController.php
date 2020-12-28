<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use App\Models\User;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 
use Auth;

class DataPustakawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!(auth()->user()->role == 'Admin'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }

        $paginate = Config::all();

        $librarians = DB::table('users')
            ->join('librarians', 'users.id', '=', 'librarians.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'librarians.address', 'librarians.phone', 'librarians.confirm_code')
            ->paginate($paginate[0]->librarian_list_page);

        $count = DB::table('users')
            ->join('librarians', 'users.id', '=', 'librarians.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'librarians.address', 'librarians.phone', 'librarians.confirm_code')
            ->count();

        return view('librarian.data-librarian', compact('librarians', 'count'));
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
            'namaLibrarian' => 'required',
            'emailLibrarian' => 'required',
            'nomorTelepon' => 'required',
            'alamatLibrarian' => 'required',
            'kodeKonfirmasi' => 'required',
            'photoLibrarian' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $code = Librarian::where('confirm_code', $request->kodeKonfirmasi)->get();

        if($code->all()) return redirect('/librarian')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else
        {
            $file = $request->file('photoLibrarian');
    
            if($file) $image = $file->getClientOriginalName();
            else $image = "default.jpg";
    
            $user = new User;
            $user->nomor_induk = $request->nomorInduk;
            $user->name = $request->namaLibrarian;
            $user->role = $request->roleLibrarian;
            $user->email = $request->emailLibrarian;
            $user->remember_token = Str::random(30);
            $user->profile_photo_path = $image;
            $user->save();
    
            $lastid = DB::table('users')
                ->select('id')
                ->orderByDesc('id')
                ->limit(1)
                ->get();
    
            $lib = new Librarian;
            $lib->id = $lastid[0]->id;
            $lib->address = $request->alamatLibrarian;
            $lib->phone = $request->nomorTelepon;
            $lib->confirm_code = $request->kodeKonfirmasi;
            $lib->save();
            
            if($file) $file->move(public_path('uploaded_files/librarian-foto/'),$file->getClientOriginalName());
            
            return redirect('/librarian')->with('success', 'Data '.$request->namaLibrarian.' berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Librarian  $librarian
     * @return \Illuminate\Http\Response
     */
    public function show(Librarian $librarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Librarian  $librarian
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $id = auth()->user()->id;
        $users = DB::table('users')
                    ->join('librarians', 'users.id', '=', 'librarians.id')
                    ->select('users.id', 'users.name', 'users.email', 'users.username', 'users.profile_photo_path', 'users.role', 'librarians.*')
                    ->where('users.id', $id)
                    ->get();

        $data = array(
            'id' => $users[0]->id,
            'name' => $users[0]->name,
            'email' => $users[0]->email,
            'username' => $users[0]->username,
            'role' => $users[0]->role,
            'phone' => $users[0]->phone,
            'address' => $users[0]->address,
            'photo' => $users[0]->profile_photo_path
        );

        return view('librarian/edit-profil', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Librarian  $librarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = auth()->user()->id;
        $users = DB::table('users')
                    ->join('librarians', 'users.id', '=', 'librarians.id')
                    ->select('librarians.id', 'users.profile_photo_path')
                    ->where('librarians.id', $id)
                    ->get();

        $validateData = $request->validate([
            'namaLibrarian' => 'required',
            'usernameLibrarian' => 'required',
            'nomorTelepon' => 'required',
            'emailLibrarian' => 'required',
            'alamatLibrarian' => 'required',
            'photoLibrarian' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $file = $request->file('photoLibrarian');

        if($file) $foto = $file->getClientOriginalName();
        else $foto = $users[0]->profile_photo_path;

        Librarian::where('id', $id)
                    ->update([
                        'phone' => $request->nomorTelepon,
                        'address' => $request->alamatLibrarian,
                        ]);

        User::where('id', $id)
                    ->update([
                        'name' => $request->namaLibrarian,
                        'email' => $request->emailLibrarian,
                        'profile_photo_path' => $foto
                        ]);

        if($file) {
            if($users[0]->profile_photo_path != "default.jpg") File::delete(public_path('uploaded_files/librarian-foto/'.$users[0]->profile_photo_path));
            $file->move(public_path('uploaded_files/librarian-foto/'),$file->getClientOriginalName());
        }
        
        return redirect('/edit-profile')->with('success', 'Data Profile berhasil diubah');
    }

    public function editPass(User $user)
    {
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $id = auth()->user()->id;
        $users = DB::table('users')
                    ->select('users.id', 'users.username')
                    ->where('users.id', $id)
                    ->get();

        $data = array(
            'id' => $users[0]->id,
            'username' => $users[0]->username,
        );

        return view('librarian/change-password', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Librarian  $librarian
     * @return \Illuminate\Http\Response
     */
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
            return redirect('/change-password')->with('failed', 'Password yang anda masukkan salah');
        }

        if(!($request->newPassword == $request->confirmPassword))
        {
            return redirect('/change-password')->with('failed', 'Password baru tidak cocok saat dikonfirmasi');
        }

        $newPass = bcrypt($request->newPassword);
        User::where('id', $id)
                    ->update([
                        'password' => $newPass,
                        ]);

        return redirect('/change-password')->with('success', 'Password berhasil diganti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Librarian  $librarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Librarian::destroy($user->id);
        User::destroy($user->id);
        if($user->profile_photo_path) {
            if($user->profile_photo_path != "default.jpg") File::delete(public_path('uploaded_files/librarian-foto/'.$user->profile_photo_path));
        }

        return redirect('/librarian')->with('success', 'Data '.$user->name.' berhasil dihapus');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function search(Request $request)
    {
        if($request->by == 'name' || $request->by == 'role') $tbl = 'users.'.$request->by;
        else $tbl = 'librarians.'.$request->by;

        $search = '%'.$request->search.'%';

        $librarians = DB::table('users')
            ->join('librarians', 'users.id', '=', 'librarians.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'librarians.address', 'librarians.phone', 'librarians.confirm_code')
            ->where($tbl, 'like', $search)
            ->paginate(3000);

        $count = DB::table('users')
            ->join('librarians', 'users.id', '=', 'librarians.id')
            ->select('users.id', 'users.nomor_induk', 'users.name', 'users.username', 'users.role', 'users.email', 'users.profile_photo_path', 'librarians.address', 'librarians.phone', 'librarians.confirm_code')
            ->where($tbl, 'like', $search)
            ->count();

        return view('librarian.data-librarian', compact('librarians', 'count'));
        // dd($request->all());
    }
    
    public function resetCode(Request $request, Librarian $librarian)
    {
        // dd($member->id);
        $validateData = $request->validate([
            'kodeKonfirmasiReset' => 'required',
        ]);

        $code = Librarian::where('confirm_code', $request->kodeKonfirmasiReset)->get();

        if($code->all()) return redirect('/librarian')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else {
            Librarian::where('id', $librarian->id)
                    ->update([
                        'confirm_code' => $request->kodeKonfirmasiReset,
                        ]);

            return redirect('/librarian')->with('success', 'Kode berhasil direset, Kode : '.$request->kodeKonfirmasiReset);
        }
    }
}
