<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\Categories;
use App\Models\Publisher;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use App\Imports\EbookImport;
use Maatwebsite\Excel\Facades\Excel;

class DataEbookController extends Controller
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
 
        $ebooks = DB::table('ebooks')
            ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
            ->join('categories', 'ebooks.category_id', '=', 'categories.id')
            ->select('ebooks.id', 'ebooks.isbn', 'ebooks.publisher_id', 'ebooks.category_id', 'ebooks.title', 'ebooks.author', 'ebooks.link', 'ebooks.image', 'ebooks.about', 'ebooks.publish_year', 'publishers.publisher', 'categories.category')
            ->paginate($paginate[0]->ebook_list_page);

        $count = DB::table('ebooks')
            ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
            ->join('categories', 'ebooks.category_id', '=', 'categories.id')
            ->select('ebooks.id', 'ebooks.publisher_id', 'ebooks.category_id', 'ebooks.title', 'ebooks.author', 'ebooks.link', 'ebooks.image', 'ebooks.about', 'publishers.publisher', 'categories.category')
            ->count();

        return view('librarian/data-ebook', compact('ebooks', 'count'));
        // dd($ebooks);
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
            'judulEbook' => 'required',
            'penerbitEbook' => 'required',
            'kategoriEbook' => 'required',
            'penulisEbook' => 'required',
            'isbnEbook' => 'required',
            'tahunTerbit' => 'required',
            'tentangEbook' => 'required',
            'fileEbook' => 'required|url',
            'gambarEbook' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $cat = Categories::where('id', $request->kategoriEbook)->get();
        $pub = Publisher::where('id', $request->penerbitEbook)->get();

        if($cat->all() && $pub->all())
        {
            $file = $request->file('gambarEbook');

            if($file) $image = $file->getClientOriginalName();
            else $image = "ebook-default.png";

            $ebook = Ebook::create([
                'isbn' => $request->isbnEbook,
                'title' => $request->judulEbook,
                'publisher_id' => $request->penerbitEbook,
                'author' => $request->penulisEbook,
                'category_id' => $request->kategoriEbook,
                'link' => $request->fileEbook,
                'image' => $image,
                'about' => $request->tentangEbook,
                'publish_year' => $request->tahunTerbit,
            ]);

            if($image != 'ebook-default.png') {
                Ebook::where('id', $ebook->id)
                    ->update([
                        'image' => $ebook->id.'/'.$image,
                        ]);
            }

            if($file) $file->move(public_path('uploaded_files/ebook-cover/'.$ebook->id.'/'),$file->getClientOriginalName());

            return redirect('/ebook')->with('success', 'Data berhasil ditambah');
            // dd($image);
        }
        else if($cat->all() && !($pub->all())) $err = 'ID Penerbit tidak ditemukan';
        else if(!($cat->all()) && $pub->all()) $err = 'ID Kategori tidak ditemukan';
        else $err = 'ID Penerbit dan Kategori tidak ditemukan';

        return redirect('/ebook')->with('failed', $err);

        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        $validateData = $request->validate([
            'judulEbook' => 'required',
            'penerbitEbook' => 'required',
            'kategoriEbook' => 'required',
            'penulisEbook' => 'required',
            'isbnEbook' => 'required',
            'tahunTerbit' => 'required',
            'tentangEbook' => 'required',
            'fileEbook' => 'required|url',
            'gambarEbook' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $cat = Categories::where('id', $request->kategoriEbook)->get();
        $pub = Publisher::where('id', $request->penerbitEbook)->get();

        if($cat->all() && $pub->all())
        {
            $file = $request->file('gambarEbook');

            if($file) $image = $ebook->id.'/'.$file->getClientOriginalName();
            else $image = $ebook->image;

            Ebook::where('id', $ebook->id)
                    ->update([
                        'isbn' => $request->isbnEbook,
                        'title' => $request->judulEbook,
                        'publisher_id' => $request->penerbitEbook,
                        'category_id' => $request->kategoriEbook,
                        'author' => $request->penulisEbook,
                        'link' => $request->fileEbook,
                        'about' => $request->tentangEbook,
                        'publish_year' => $request->tahunTerbit,
                        'image' => $image,
                        ]);

            if($file) {
                if($ebook->image != "ebook-default.png") File::delete(public_path('uploaded_files/ebook-cover/'.$ebook->image));
                $file->move(public_path('uploaded_files/ebook-cover/'.$ebook->id.'/'),$file->getClientOriginalName());
            }

            return redirect('/ebook')->with('success', 'Data berhasil diubah');
            // dd($image);
        }
        else if($cat->all() && !($pub->all())) $err = 'ID Penerbit tidak ditemukan';
        else if(!($cat->all()) && $pub->all()) $err = 'ID Kategori tidak ditemukan';
        else $err = 'ID Penerbit dan Kategori tidak ditemukan';

        return redirect('/ebook')->with('failed', $err);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        Ebook::destroy($ebook->id);
        if($ebook->image) {
            if($ebook->image != "ebook-default.png") File::deleteDirectory(public_path('uploaded_files/ebook-cover/'.$ebook->id));
        }

        return redirect('/ebook')->with('success', 'Data '.$ebook->title.' berhasil dihapus');
    }

    public function search(Request $request)
    {
        if($request->by == 'category') $tbl = 'categories.'.$request->by;
        else if($request->by == 'publisher') $tbl = 'publishers.'.$request->by;
        else $tbl = 'ebooks.'.$request->by;

        $search = '%'.$request->search.'%';

        $ebooks = DB::table('ebooks')
            ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
            ->join('categories', 'ebooks.category_id', '=', 'categories.id')
            ->select('ebooks.*', 'publishers.publisher', 'categories.category')
            ->where($tbl, 'like', $search)
            ->paginate(3000);

        $count = DB::table('ebooks')
            ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
            ->join('categories', 'ebooks.category_id', '=', 'categories.id')
            ->select('ebooks.*', 'publishers.publisher', 'categories.category')
            ->where($tbl, 'like', $search)
            ->count();

        return view('librarian.data-ebook', compact('ebooks', 'count'));
        // dd($request->request);
    }

    public function importEbook(Request $request) {
        $validateData = $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new EbookImport, $request->file);

        return redirect('/ebook')->with('success', 'Data berhasil ditambah');
    }
}
