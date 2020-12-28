<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Book;
use App\Models\Ebook;
use App\Models\GalleryConfig;

class LandingPageController extends Controller
{
    public function index()
    {
        $sum_categories = Categories::all()->count();
        $sum_books = Book::all()->count();
        $sum_ebooks = Ebook::all()->count();
        $gallery = GalleryConfig::all();

        return view('landing-page/landing', compact('sum_categories', 'sum_books', 'sum_ebooks', 'gallery'));
    }
}
