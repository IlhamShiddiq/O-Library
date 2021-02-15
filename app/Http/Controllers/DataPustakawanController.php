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
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerification;
use App\Mail\ResendVerification;
use App\Imports\LibrarianImport;
use Maatwebsite\Excel\Facades\Excel;
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

    public function librarianDetail(Librarian $librarian) 
    {
        $datas = Librarian::join('users', 'users.id', '=', 'librarians.id')
                        ->select('users.*', 'librarians.address', 'librarians.phone')
                        ->where('librarians.id', $librarian->id)
                        ->get();

        return view('librarian.detail-librarian', ['data' => $datas[0]]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nomorInduk' => 'required',
            'namaLibrarian' => 'required',
            'emailLibrarian' => 'required',
            'nomorTelepon' => 'required',
            'alamatLibrarian' => 'required',
            'photoLibrarian' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $code_generate = '';
        for($i=0; $i<6; $i++){
            $code_generate .= rand(0, 9);
        }

        $code = Librarian::where('confirm_code', $code_generate)->get();

        if($code->all()) return redirect('/librarian')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else
        {
            $file = $request->file('photoLibrarian');
    
            if($file) $image = $request->nomorInduk.'/'.$file->getClientOriginalName();
            else $image = "default.jpg";
    
            $user = User::create([
                'nomor_induk' => $request->nomorInduk,
                'name' => $request->namaLibrarian,
                'role' => $request->roleLibrarian,
                'email' => $request->emailLibrarian,
                'remember_token' => Str::random(30),
                'profile_photo_path' => $image,
            ]);

            $lib = Librarian::create([
                'id' => $user->id,
                'address' => $request->alamatLibrarian,
                'phone' => $request->nomorTelepon,
                'confirm_code' => $code_generate,
            ]);
            
            if($file) $file->move(public_path('uploaded_files/librarian-foto/'.$request->nomorInduk.'/'),$file->getClientOriginalName());

            Mail::to($user->email, $user->name)->send(new SendVerification($user));
            
            return redirect('/librarian')->with('success', 'Data '.$request->namaLibrarian.' berhasil disimpan. Kode verifikasi berhasil terkirim');
        }
    }

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
                    ->select('nomor_induk', 'librarians.id', 'users.profile_photo_path')
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

        if($file) $foto = $users[0]->nomor_induk.'/'.$file->getClientOriginalName();
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
            $file->move(public_path('uploaded_files/librarian-foto/'.$users[0]->nomor_induk.'/'),$file->getClientOriginalName());
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
            if($user->profile_photo_path != "default.jpg") File::deleteDirectory(public_path('uploaded_files/librarian-foto/'.$user->nomor_induk));
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
        $code_generate = '';
        for($i=0; $i<6; $i++){
            $code_generate .= rand(0, 9);
        }

        $code = Librarian::where('confirm_code', $code_generate)->get();

        if($code->all()) return redirect('/librarian')->with('failed', 'Kode konfirmasi yang dibuat sudah ada');
        else {
            Librarian::where('id', $librarian->id)
                    ->update([
                        'confirm_code' => $code_generate,
                        ]);

            $user = User::find($librarian->id);
            Mail::to($user->email, $user->name)->send(new ResendVerification($user));

            return redirect('/librarian')->with('success', 'Kode berhasil direset, Kode verifikasi berhasil dikirim ke email pengguna');
        }
    }

    
    public function importLibrarian(Request $request) {
        $validateData = $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new LibrarianImport, $request->file);

        return redirect('/librarian')->with('success', 'Data berhasil ditambah');
    }
}
