<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Imports\CategoryImport;
use Maatwebsite\Excel\Facades\Excel;

class DataCategoryController extends Controller
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

        $paginate = Config::all();
 
        $categories = Categories::paginate($paginate[0]->category_list_page);

        $count = Categories::all()->count();

        return view('librarian/data-category', compact('categories', 'count'));
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
            'kategoriBuku' => 'required',
        ]);

        $cat = new Categories;
        $cat->category = $request->kategoriBuku;
        $cat->save();

        return redirect('/category')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        $validateData = $request->validate([
            'kategoriBuku' => 'required',
        ]);

        Categories::where('id', $categories->id)
                    ->update([
                        'category' => $request->kategoriBuku,
                        ]);

        return redirect('/category')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {
        Categories::destroy($categories->id);

        return redirect('/category')->with('success', 'Data berhasil dihapus');
    }

    public function search(Request $request) 
    {
        $word = '%'.$request->input('search').'%';

        $categories = Categories::where('category', 'like', $word)->paginate(1000);

        $count = Categories::where('category', 'like', $word)->count();

        return view('librarian/data-category', compact('categories', 'count'));
    }
    
    public function importCategory(Request $request) {
        Excel::import(new CategoryImport, $request->file);

        return redirect('/category')->with('success', 'Data berhasil ditambah');
    }
}
