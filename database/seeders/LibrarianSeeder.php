<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Librarian;

class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nomor_induk' => '030703',
            'username' => 'halolibrarian',
            'password' => bcrypt('halolibrarian'),
            'name' => 'Default User Librarian',
            'role' => 'Pustakawan',
            'email' => 'defaultlibrarian@default.com',
            'remember_token' => Str::random(30),
            'profile_photo_path' => 'default.jpg',
        ]);

        $lib = Librarian::create([
            'id' => $user->id,
            'address' => 'Default Address',
            'phone' => '37337s3',
            'confirm_code' => '0'
        ]);
    }
}
