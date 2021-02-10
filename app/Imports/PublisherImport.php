<?php

namespace App\Imports;

use App\Models\Publisher;
use Maatwebsite\Excel\Concerns\ToModel;

class PublisherImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $publisher = Publisher::create([
            'id' => $row[0],
            'publisher' => $row[1]
        ]);

        return $publisher;
    }
}
