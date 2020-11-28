<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Book;
use App\Models\Ebook;
use App\Models\Librarian;
use App\Models\Member;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        if(!(auth()->user()->role == 'Pustakawan' || auth()->user()->role == 'Admin'))
        {
            return redirect('/member/dashboard')->with('failed', 'Anda tidak diizinkan untuk mengakses halaman tersebut');
        }

        $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
        $tuesday = date( 'Y-m-d', strtotime( 'tuesday this week' ) );
        $wednesday = date( 'Y-m-d', strtotime( 'wednesday this week' ) );
        $thursday = date( 'Y-m-d', strtotime( 'thursday this week' ) );
        $friday = date( 'Y-m-d', strtotime( 'friday this week' ) );
 
        $sum_categories = Categories::all()->count();
        $sum_books = Book::all()->count();
        $sum_ebooks = Ebook::all()->count();
        $sum_librarians = Librarian::all()->count();
        $sum_libs = User::where('role', 'Pustakawan')->count();
        $sum_adms = User::where('role', 'Admin')->count();
        $sum_members = Member::all()->count();
        $sum_teacher = Member::where('status', 'Guru')->count();
        $sum_student = Member::where('status', 'Siswa')->count();
        $monday_transaction = Transaction::where('borrow_date', $monday)->count();
        $tuesday_transaction = Transaction::where('borrow_date', $tuesday)->count();
        $wednesday_transaction = Transaction::where('borrow_date', $wednesday)->count();
        $thursday_transaction = Transaction::where('borrow_date', $thursday)->count();
        $friday_transaction = Transaction::where('borrow_date', $friday)->count();

        return view('librarian/dashboard', compact('sum_categories', 'sum_books', 'sum_ebooks', 'sum_librarians', 'sum_libs', 'sum_adms', 'sum_members', 'sum_teacher', 'sum_student', 'monday_transaction', 'tuesday_transaction', 'wednesday_transaction', 'thursday_transaction', 'friday_transaction'));
    }
}
