<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Librarian;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nomor_induk' => '373373',
            'username' => 'sayasukaadmin',
            'password' => bcrypt('sayasukaadmin'),
            'name' => 'Default User',
            'role' => 'Admin',
            'email' => 'default@default.com',
            'remember_token' => Str::random(30),
            'profile_photo_path' => 'default.jpg',
        ]);

        $lib = Librarian::create([
            'id' => $user->id,
            'address' => 'Default Address',
            'phone' => '373373',
            'confirm_code' => '0'
        ]);
    }
}
