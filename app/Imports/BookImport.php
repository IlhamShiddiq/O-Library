<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BookImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $book = Book::create([
            'isbn' => $row[0],
            'title' => $row[1],
            'publisher_id' => $row[2],
            'author' => $row[3],
            'category_id' => $row[4],
            'qty' => $row[5],
            'image' => 'book-default.png',
            'about' => $row[6],
            'publish_year' => $row[7]
        ]);

        return $book;
    }
}
