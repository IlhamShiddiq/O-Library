<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;
use App\Models\GalleryConfig;

class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conf = Config::create([
            'late_charge' => 1000,
            'loan_deadline' => 14,
            'book_list_page' => 5,
            'member_list_page' => '5',
            'librarian_list_page' => '5',
            'ebook_list_page' => '5',
            'publisher_list_page' => '5',
            'category_list_page' => '5',
            'permission_list_page' => '5',
            'transaction_list_page' => '5',
            'report_list_page' => '5',
            'bg_member' => 'bg.jpg'
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-1.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-2.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-3.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-4.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-5.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-6.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-7.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-8.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-9.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-10.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-11.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-12.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-13.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-14.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-15.jpg',
        ]);

        $galleryconf = GalleryConfig::create([
            'gallery_picture' => 'gallery-16.jpg',
        ]);
    }
}
