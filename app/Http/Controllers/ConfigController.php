<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\GalleryConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Config::all();
        $data = $data[0];
        $gallery = GalleryConfig::all();

        return view('librarian/config-page', compact('data', 'gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function returnConfig(Request $request)
    {
        $validateData = $request->validate([
            'batas_kembali' => 'required|numeric|min:1',
            'denda' => 'required|numeric|min:0',
        ]);

        Config::where('id', 1)
             ->update([
                 'loan_deadline' => $request->batas_kembali,
                 'late_charge' => $request->denda
             ]);
        
        return redirect('/config')->with('success', 'Konfigurasi berhasil diperbarui');
    }

    public function dataListConfig(Request $request)
    {
        $validateData = $request->validate([
            'book_list' => 'required|numeric|min:5|max:15',
            'member_list' => 'required|numeric|min:5|max:15',
            'librarian_list' => 'required|numeric|min:5|max:15',
            'ebook_list' => 'required|numeric|min:5|max:15',
            'publisher_list' => 'required|numeric|min:5|max:15',
            'category_list' => 'required|numeric|min:5|max:15',
            'permission_list' => 'required|numeric|min:5|max:15',
            'transaction_list' => 'required|numeric|min:5|max:15',
            'report_list' => 'required|numeric|min:5|max:15',
        ]);

        Config::where('id', 1)
             ->update([
                 'book_list_page' => $request->book_list,
                 'member_list_page' => $request->member_list,
                 'librarian_list_page' => $request->librarian_list,
                 'ebook_list_page' => $request->ebook_list,
                 'publisher_list_page' => $request->publisher_list,
                 'category_list_page' => $request->category_list,
                 'permission_list_page' => $request->permission_list,
                 'transaction_list_page' => $request->transaction_list,
                 'report_list_page' => $request->report_list,
             ]);
        
        return redirect('/config')->with('success', 'Konfigurasi berhasil diperbarui');
    }

    public function memberBg(Request $request)
    {
        $validateData = $request->validate([
            'file' => 'required|mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $file = $request->file('file');

        $config = Config::select('bg_member')
                        ->where('id', 1)
                        ->get();

        File::delete(public_path('img/bg/'.$config[0]->bg_member));

        $update = Config::where('id', 1)
                        ->update([
                            'bg_member' => $file->getClientOriginalName()
                        ]);

        $file->move(public_path('img/bg/'),$file->getClientOriginalName());

        return redirect('/config')->with('success', 'Konfigurasi berhasil diperbarui');
    }

    public function galleryConfig(Request $request)
    {
        $validateData = $request->validate([
            'gallery_1' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_2' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_3' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_4' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_5' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_6' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_7' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_8' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_9' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_10' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_11' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_12' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_13' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_14' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_15' => 'mimes:jpeg,jpg,bmp,png|max:2000',
            'gallery_16' => 'mimes:jpeg,jpg,bmp,png|max:2000'
        ]);

        $config = GalleryConfig::all();

        if($request->gallery_1)
        {
            $file = $request->file('gallery_1');

            File::delete(public_path('img/galleries/gallery-1/'.$config[0]->gallery_picture));

            $update = GalleryConfig::where('id', 1)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-1/'),$file->getClientOriginalName());
        }

        if($request->gallery_2)
        {
            $file = $request->file('gallery_2');

            File::delete(public_path('img/galleries/gallery-2/'.$config[1]->gallery_picture));

            $update = GalleryConfig::where('id', 2)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-2/'),$file->getClientOriginalName());
        }

        if($request->gallery_3)
        {
            $file = $request->file('gallery_3');

            File::delete(public_path('img/galleries/gallery-3/'.$config[2]->gallery_picture));

            $update = GalleryConfig::where('id', 3)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-3/'),$file->getClientOriginalName());
        }

        if($request->gallery_4)
        {
            $file = $request->file('gallery_4');

            File::delete(public_path('img/galleries/gallery-4/'.$config[3]->gallery_picture));

            $update = GalleryConfig::where('id', 4)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-4/'),$file->getClientOriginalName());
        }

        if($request->gallery_5)
        {
            $file = $request->file('gallery_5');

            File::delete(public_path('img/galleries/gallery-5/'.$config[4]->gallery_picture));

            $update = GalleryConfig::where('id', 5)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-5/'),$file->getClientOriginalName());
        }

        if($request->gallery_6)
        {
            $file = $request->file('gallery_6');

            File::delete(public_path('img/galleries/gallery-6/'.$config[5]->gallery_picture));

            $update = GalleryConfig::where('id', 6)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-6/'),$file->getClientOriginalName());
        }

        if($request->gallery_7)
        {
            $file = $request->file('gallery_7');

            File::delete(public_path('img/galleries/gallery-7/'.$config[6]->gallery_picture));

            $update = GalleryConfig::where('id', 7)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-7/'),$file->getClientOriginalName());
        }

        if($request->gallery_8)
        {
            $file = $request->file('gallery_8');

            File::delete(public_path('img/galleries/gallery-8/'.$config[7]->gallery_picture));

            $update = GalleryConfig::where('id', 8)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-8/'),$file->getClientOriginalName());
        }

        if($request->gallery_9)
        {
            $file = $request->file('gallery_9');

            File::delete(public_path('img/galleries/gallery-9/'.$config[8]->gallery_picture));

            $update = GalleryConfig::where('id', 9)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-9/'),$file->getClientOriginalName());
        }

        if($request->gallery_10)
        {
            $file = $request->file('gallery_10');

            File::delete(public_path('img/galleries/gallery-10/'.$config[9]->gallery_picture));

            $update = GalleryConfig::where('id', 10)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-10/'),$file->getClientOriginalName());
        }

        if($request->gallery_11)
        {
            $file = $request->file('gallery_11');

            File::delete(public_path('img/galleries/gallery-11/'.$config[10]->gallery_picture));

            $update = GalleryConfig::where('id', 11)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-11/'),$file->getClientOriginalName());
        }

        if($request->gallery_12)
        {
            $file = $request->file('gallery_12');

            File::delete(public_path('img/galleries/gallery-12/'.$config[11]->gallery_picture));

            $update = GalleryConfig::where('id', 12)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-12/'),$file->getClientOriginalName());
        }

        if($request->gallery_13)
        {
            $file = $request->file('gallery_13');

            File::delete(public_path('img/galleries/gallery-13/'.$config[12]->gallery_picture));

            $update = GalleryConfig::where('id', 13)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-13/'),$file->getClientOriginalName());
        }

        if($request->gallery_14)
        {
            $file = $request->file('gallery_14');

            File::delete(public_path('img/galleries/gallery-14/'.$config[13]->gallery_picture));

            $update = GalleryConfig::where('id', 14)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-14/'),$file->getClientOriginalName());
        }

        if($request->gallery_15)
        {
            $file = $request->file('gallery_15');

            File::delete(public_path('img/galleries/gallery-15/'.$config[14]->gallery_picture));

            $update = GalleryConfig::where('id', 15)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-15/'),$file->getClientOriginalName());
        }

        if($request->gallery_16)
        {
            $file = $request->file('gallery_16');

            File::delete(public_path('img/galleries/gallery-16/'.$config[15]->gallery_picture));

            $update = GalleryConfig::where('id', 16)
                                    ->update([
                                        'gallery_picture' => $file->getClientOriginalName()
                                    ]);

            $file->move(public_path('img/galleries/gallery-16/'),$file->getClientOriginalName());
        }

        return redirect('/config')->with('success', 'Konfigurasi berhasil diperbarui');

    }
}