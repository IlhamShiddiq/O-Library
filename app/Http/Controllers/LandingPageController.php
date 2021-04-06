<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Book;
use App\Models\Ebook;
use App\Models\GalleryConfig;
use App\Models\Article;

class LandingPageController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $day = date('l');
        $day_in_bahasa = '';
        switch($day) {
            case 'Monday':
                $day_in_bahasa = 'Senin';
                break;
            case 'Tuesday':
                $day_in_bahasa = 'Selasa';
                break;
            case 'Wednesday':
                $day_in_bahasa = 'Rabu';
                break;
            case 'Thursday':
                $day_in_bahasa = 'Kamis';
                break;
            case 'Friday':
                $day_in_bahasa = 'Jumat';
                break;
            case 'Saturday':
                $day_in_bahasa = 'Sabtu';
                break;
            case 'Sunday':
                $day_in_bahasa = 'Minggu';
                break;
            default:
                $day_in_bahasa = '-Hari ini-';
                break;
        }

        $date = date('d F Y');
        $today = $day_in_bahasa.', tanggal '.$date;

        $sum_categories = Categories::all()->count();
        $sum_books = Book::all()->count();
        $sum_ebooks = Ebook::all()->count();
        $gallery = GalleryConfig::all();
        $articles = Article::where('public', '1')->limit(4)->orderByDesc('created_at')->get();

        return view('landing-page/landing', compact('sum_categories', 'sum_books', 'sum_ebooks', 'gallery', 'articles', 'today'));
    }
}
