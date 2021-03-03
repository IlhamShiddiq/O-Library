<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Imports\PublisherImport;
use Maatwebsite\Excel\Facades\Excel;

class DataPublisherController extends Controller
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
 
        $publishers = Publisher::paginate($paginate[0]->publisher_list_page);

        $count = Publisher::all()->count();

        return view('librarian/data-publisher', compact('publishers', 'count', 'isSearch'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'penerbitBuku' => 'required',
        ]);

        $pub = Publisher::create([
            'publisher' => $request->penerbitBuku,
        ]);

        return redirect('/publisher')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, Publisher $publisher)
    {
        $validateData = $request->validate([
            'penerbitBuku' => 'required',
        ]);

        Publisher::where('id', $publisher->id)
                    ->update([
                        'publisher' => $request->penerbitBuku,
                        ]);

        return redirect('/publisher')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        Publisher::destroy($publisher->id);

        return redirect('/publisher')->with('success', 'Data berhasil dihapus');
    }

    public function search(Request $request) 
    {
        $isSearch = 'display: none';
        $word = '%'.$request->input('search').'%';

        $publishers = Publisher::where('publisher', 'like', $word)->paginate(1000);

        $count = Publisher::where('publisher', 'like', $word)->count();

        return view('librarian/data-publisher', compact('publishers', 'count', 'isSearch'));
    }

    public function importPublisher(Request $request) {
        $validateData = $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new PublisherImport, $request->file);

        return redirect('/publisher')->with('success', 'Data berhasil ditambah');
    }
}
