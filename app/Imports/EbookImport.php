<?php

namespace App\Imports;

use App\Models\Ebook;
use Maatwebsite\Excel\Concerns\ToModel;

class EbookImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $ebook = Ebook::create([
            'isbn' => $row[0],
            'title' => $row[1],
            'publisher_id' => $row[2],
            'author' => $row[3],
            'category_id' => $row[4],
            'link' => $row[5],
            'image' => 'book-default.png',
            'about' => $row[6],
            'publish_year' => $row[7]
        ]);

        return $ebook;
    }
}
