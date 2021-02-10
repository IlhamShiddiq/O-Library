<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;

class MemberImport implements ToModel
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

        $member = Member::create([
            'id' => $user->id,
            'address' => $row[4],
            'phone' => $row[5],
            'status' => $row[6],
            'class' => $row[7],
            'confirm_code' => $row[8]
        ]);

        return [$user, $member];
    }
}
