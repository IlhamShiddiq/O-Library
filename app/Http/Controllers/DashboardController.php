<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Book;
use App\Models\Ebook;
use App\Models\Librarian;
use App\Models\Member;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $sum_categories = Categories::all()->count();
        $sum_books = Book::all()->count();
        $sum_ebooks = Ebook::all()->count();
        $sum_librarians = Librarian::all()->count();
        $sum_libs = User::where('role', 'Pustakawan')->count();
        $sum_adms = User::where('role', 'Admin')->count();
        $sum_members = Member::all()->count();
        $sum_teacher = Member::where('status', 'Guru')->count();
        $sum_student = Member::where('status', 'Siswa')->count();

        return view('librarian/dashboard', compact('sum_categories', 'sum_books', 'sum_ebooks', 'sum_librarians', 'sum_libs', 'sum_adms', 'sum_members', 'sum_teacher', 'sum_student'));
    }
}
