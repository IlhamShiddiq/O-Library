<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

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
            return redirect('/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halam tersebut');
        }
 
        $publishers = Publisher::paginate(10);

        $count = Publisher::all()->count();

        return view('librarian/data-publisher', compact('publishers', 'count'));
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
            'penerbitBuku' => 'required',
        ]);

        $pub = new Publisher;
        $pub->publisher = $request->penerbitBuku;
        $pub->save();

        return redirect('/publisher')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
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
        $word = '%'.$request->input('search').'%';

        $publishers = Publisher::where('publisher', 'like', $word)->paginate(1000);

        $count = Publisher::where('publisher', 'like', $word)->count();

        return view('librarian/data-publisher', compact('publishers', 'count'));
    }
}
