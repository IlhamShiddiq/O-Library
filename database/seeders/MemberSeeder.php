<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Member;

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nomor_induk' => '011002',
            'username' => 'halomember',
            'password' => bcrypt('halomember'),
            'name' => 'Default User Member',
            'role' => 'Member',
            'email' => 'defaultmember@default.com',
            'remember_token' => Str::random(30),
            'profile_photo_path' => 'default.jpg',
        ]);

        $mem = Member::create([
            'id' => $user->id,
            'address' => 'Default Address',
            'phone' => '37337s3',
            'status' => 'Guru',
            'class' => '',
            'confirm_code' => '0'
        ]);
    }
}
