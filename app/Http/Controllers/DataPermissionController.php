<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Ebook;
use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsingEbook;
use App\Mail\AcceptedEbook;
use App\Mail\RejectedEbook;

class DataPermissionController extends Controller
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
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        date_default_timezone_set('Asia/Jakarta');
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }

        $paginate = Config::all();

        $permissions = Permission::join('ebooks', 'permissions.id_ebook', '=', 'ebooks.id')
                                ->join('users', 'permissions.id_member', '=', 'users.id')
                                ->select('ebooks.title', 'users.nomor_induk', 'permissions.*')
                                ->orderByDesc('id')
                                ->paginate($paginate[0]->permission_list_page);

        $count = Permission::all()->count();
        $requested = Permission::where('confirmed', 0)->count();
        $expired = Permission::where('limit_date', '<', date('Y-m-d'))->count();
        $refused = Permission::where('accepted', 0)->count();
 
        return view('librarian/data-permission', compact('permissions', 'count', 'requested', 'expired', 'refused'));
    }

    public function store(Request $request, Ebook $ebook)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validateData = $request->validate([
            'alasan' => 'required'
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $check_load_req = Permission::select('permissions.id')
                                    ->where('id_member', auth()->user()->id)
                                    ->where('id_ebook', $ebook->id)
                                    ->where('confirmed', '0')
                                    ->get();

        $check_ebook_avaliable = Permission::select('permissions.id')
                                            ->where('id_member', auth()->user()->id)
                                            ->where('id_ebook', $ebook->id)
                                            ->where('accepted', '1')
                                            ->where('limit_date', '>', date('Y-m-d'))
                                            ->get();

        if($check_load_req->all()) return redirect('/member/ebook/detail/'.$ebook->id)->with('failed', 'Ebook ini telah anda ajukan sebelumnya, mohon tunggu hingga dikonfirmasi');

        if($check_ebook_avaliable->all()) return redirect('/member/ebook/detail/'.$ebook->id)->with('failed', 'Ebook ini sedang anda pakai');

        $permission = new Permission;
        $permission->id_member = auth()->user()->id;
        $permission->id_ebook = $ebook->id;
        $permission->reason = $request->alasan;
        $permission->confirmed = '0';
        $permission->submit_date = date("Y-m-d");
        $permission->save();

        Mail::to(auth()->user()->email, auth()->user()->name)->send(new UsingEbook(auth()->user()));

        return redirect('/member/ebook/detail/'.$ebook->id)->with('success', 'Berhasil diajukan, mohon tunggu hingga pengajuan dikonfirmasi');

    }

    public function permissionAccept(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $limit = date('Y-m-d', strtotime('+14 days', strtotime( date('Y-m-d') )));

        Permission::where('id', $request->id)
                    ->update([
                        'confirmed' => '1',
                        'accepted' => '1',
                        'limit_date' => $limit
                        ]);

        $permission = Permission::find($request->id);
        $user = User::find($permission->id_member);

        Mail::to($user->email, $user->name)->send(new AcceptedEbook($user, $permission));

        return redirect('/permission')->with('success', 'Ajuan telah disetujui');
    }

    public function permissionRefuse(Request $request)
    {
        if(!$request->alasan) return redirect('permission')->with('failed', 'Field alasan penolakan harus diisi');
        Permission::where('id', $request->id)
                    ->update([
                        'confirmed' => '1',
                        'accepted' => '0',
                        'reason_for_rejection' => $request->alasan
                    ]);

        $permission = Permission::find($request->id);
        $user = User::find($permission->id_member);

        Mail::to($user->email, $user->name)->send(new RejectedEbook($user, $permission));

        return redirect('/permission')->with('success', 'Ajuan telah ditolak');
    }

    public function deleteExpired()
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        date_default_timezone_set('Asia/Jakarta');
        Permission::where('limit_date', '<', date('Y-m-d'))->delete();

        return redirect('permission')->with('success', 'Daftar yang kadaluarsa berhasil dihapus');
    }

    public function deleteRefused()
    {
        if(!(auth()->user()->role == 'Pustakawan'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        Permission::where('accepted', 0)->delete();

        return redirect('permission')->with('success', 'Daftar yang ditolak berhasil dihapus');
    }
}
