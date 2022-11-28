<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ConfigsSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(LibrarianSeeder::class);
        $this->call(MemberSeeder::class);
    }
}
