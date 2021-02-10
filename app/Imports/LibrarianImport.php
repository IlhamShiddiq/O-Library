<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Librarian;
use Maatwebsite\Excel\Concerns\ToModel;

class LibrarianImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'nomor_induk' => $row[0],
            'name' => $row[1],
            'role' => $row[2],
            'email' => $row[3],
            'profile_photo_path' => 'default.jpg'
        ]);

        $librarian = Librarian::create([
            'id' => $user->id,
            'address' => $row[4],
            'phone' => $row[5],
            'confirm_code' => $row[6]
        ]);

        return [$user, $librarian];
    }
}
