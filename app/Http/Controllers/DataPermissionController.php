<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }

        $permissions = Permission::join('ebooks', 'permissions.id_ebook', '=', 'ebooks.id')
                                ->select('ebooks.title', 'permissions.*')
                                ->orderByDesc('id')
                                ->paginate(10);

        $count = Permission::all()->count();
        $requested = Permission::where('confirmed', 0)->count();
        $expired = Permission::where('limit_date', '<', date('Y-m-d'))->count();
        $refused = Permission::where('accepted', 0)->count();
 
        return view('librarian/data-permission', compact('permissions', 'count', 'requested', 'expired', 'refused'));
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
    public function store(Request $request, Ebook $ebook)
    {
        $validateData = $request->validate([
            'alasan' => 'required'
        ]);

        $check = DB::table('permissions')
                    ->select('permissions.id')
                    ->where('id_member', auth()->user()->id)
                    ->where('id_ebook', $ebook->id)
                    ->get();

        if($check->all()) return redirect('/member/ebook/detail/'.$ebook->id)->with('failed', 'Ebook ini telah anda ajukan sebelumnya, mohon tunggu hingga dikonfirmasi');

        $permission = new Permission;
        $permission->id_member = auth()->user()->id;
        $permission->id_ebook = $ebook->id;
        $permission->reason = $request->alasan;
        $permission->confirmed = '0';
        $permission->submit_date = date("Y-m-d");
        $permission->save();

        return redirect('/member/ebook/detail/'.$ebook->id)->with('success', 'Berhasil diajukan, mohon tunggu hingga pengajuan dikonfirmasi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }

    public function permissionAccept(Request $request)
    {
        $limit = date('Y-m-d', strtotime('+14 days', strtotime( date('Y-m-d') )));

        Permission::where('id', $request->id)
                    ->update([
                        'confirmed' => '1',
                        'accepted' => '1',
                        'limit_date' => $limit
                        ]);

        return redirect('/permission')->with('success', 'Ajuan telah disetujui');
    }

    public function permissionRefuse(Request $request)
    {
        Permission::where('id', $request->id)
                    ->update([
                        'confirmed' => '1',
                        'accepted' => '0',
                        ]);

        return redirect('/permission')->with('success', 'Ajuan telah ditolak');
    }

    public function deleteExpired()
    {
        Permission::where('limit_date', '<', date('Y-m-d'))->delete();

        return redirect('permission')->with('success', 'Daftar yang kadaluarsa berhasil dihapus');
    }

    public function deleteRefused()
    {
        Permission::where('accepted', 0)->delete();

        return redirect('permission')->with('success', 'Daftar yang ditolak berhasil dihapus');
    }
}
