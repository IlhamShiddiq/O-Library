<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Book;
use App\Models\Ebook;
use App\Models\Member;
use App\Models\User;
use App\Models\Publisher;
use App\Models\Categories;
use App\Models\Transaction;

class ReportSheetsItem implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithStyles
{
    private $item;

    public function __construct(string $item)
    {
        $this->item = $item;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
    }

    public function headings(): array
    {
        if($this->item == 'Book') {
            $cols = ['ID', 'ISBN', 'Judul', 'Penerbit', 'Penulis', 'Kategori', 'Stok', 'Sinopsis', 'Tahun terbit'];
        }
        else if($this->item == 'Ebook') {
            $cols = ['ID', 'ISBN', 'Judul', 'Penerbit', 'Penulis', 'Kategori', 'Sinopsis', 'Tahun terbit'];
        }
        else if($this->item == 'Member') {
            $cols = ['ID', 'NIS/NIP', 'Nama', 'Username', 'Email', 'Alamat', 'No. Telepon', 'Status', 'Kelas'];
        }
        else if($this->item == 'Librarian') {
            $cols = ['ID', 'NIS/NIP', 'Nama', 'Username', 'Email', 'Alamat', 'No. Telepon'];
        }
        else if($this->item == 'Publisher') {
            $cols = ['ID', 'Penerbit'];
        }
        else if($this->item == 'Category') {
            $cols = ['ID', 'Kategori'];
        }
        else if($this->item == 'Report') {
            $cols = ['ID', 'Nama Anggota', 'ID Pustakawan', 'Tangal Pinjam', 'Buku', 'Tanggal Kembali', 'Status'];
        }

        return $cols;
    }

    public function collection()
    {
        if($this->item == 'Book') {
            $data = Book::select('books.id', 'isbn', 'title', 'publisher', 'author', 'category', 'qty', 'about', 'publish_year')
                        ->join('publishers', 'books.publisher_id', '=', 'publishers.id')
                        ->join('categories', 'books.category_id', '=', 'categories.id')
                        ->get();
        }
        else if($this->item == 'Ebook') {
            $data = Ebook::select('ebooks.id', 'isbn', 'title', 'publisher', 'author', 'category', 'about', 'publish_year')
                        ->join('publishers', 'ebooks.publisher_id', '=', 'publishers.id')
                        ->join('categories', 'ebooks.category_id', '=', 'categories.id')
                        ->get();
        }
        else if($this->item == 'Member') {
            $data = User::select('users.id', 'nomor_induk', 'name', 'username', 'email', 'address', 'phone', 'status', 'class')
                        ->join('members', 'users.id', '=', 'members.id')
                        ->where('users.role', 'Member')
                        ->get();
        }
        else if($this->item == 'Librarian') {
            $data = User::select('users.id', 'nomor_induk', 'name', 'username', 'email', 'address', 'phone')
                        ->join('librarians', 'users.id', '=', 'librarians.id')
                        ->where('users.role', 'Pustakawan')
                        ->orWhere('users.role', 'Admin')
                        ->get();
        }
        else if($this->item == 'Publisher') {
            $data = Publisher::select('id', 'publisher')
                        ->get();
        }
        else if($this->item == 'Category') {
            $data = Categories::select('id', 'category')
                        ->get();
        }
        else if($this->item == 'Report') {
            $data = Transaction::select('transactions.id', 'users.name', 'librarian_id',     'borrow_date', 'books.title', 'date_of_return', 'status')
                        ->join('detail_transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
                        ->join('users', 'transactions.member_id', '=', 'users.id')
                        ->join('books', 'detail_transactions.book_id', '=', 'books.id')
                        ->get();
        }

        return $data;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->item;
    }
}
