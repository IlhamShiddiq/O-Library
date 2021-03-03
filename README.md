![OLibrary](https://i.imgur.com/WWqKDdR.png?1) <br>
# O'Library
Web aplikasi yang bergerak di bidang pembukuan perpustakaan sekolah.

## Pemasangan Web Aplikasi
### 1. Sofware yang dibutuhkan
Sebelum memulai pemasangan, pastikan bahwa di perangkat anda sudah dipasang Composer versi terbaru dan juga NodeJS
* Composer : bisa didownload [disini](https://getcomposer.org/)
* NodeJS : bisa didownload [disini](https://nodejs.org/en/)
### 2. Pemasangan
* Pada perangkat anda, buat database yang bernamakan `olibrary`
* Download semua file projek yang ada di github ini, ekstrak lalu buka command prompt/terminal yang mengarah pada path file projek tersebut
* Ketikkan `composer install`, lalu enter
* Ketikkan `npm install`, lalu enter
* Ketikkan `cp .env.example .env`, lalu enter
* Buka file bernamakan `.env`, lalu cari `DB_DATABASE` dan isikan dengan `olibrary`
* Ketikkan `php artisan key:generate`, lalu enter
* Ketikkan `php artisan migrate`, lalu enter
* Ketikkan `php artisan db:seed --class=ConfigsSeeder`, lalu enter
* Ketikkan `php artisan de:seed --class=AdminSeeder`, lalu enter
* Ketikkan `php artisan de:seed --class=LibrarianSeeder`, lalu enter
* Ketikkan `php artisan de:seed --class=MemberSeeder`, lalu enter
* Terakhir, ketikkan `php artisan serve`, lalu buka web dengan mengetikkan url `localhost:8000` pada browser anda

## Akun
### Admin
* Username : haloadmin
* Password : haloadmin
### Pustakawan
* Username : halolibrarian
* Password : halolibrarian
### Member
* Username : halomember
* Password : halomember

## Dibuat menggunakan
Web ini dibangun menggunakan
* [Laravel v 8](https://laravel.com/docs/8.x)
* [Bootstrap](https://getbootstrap.com/docs/4.5/getting-started/introduction/)


All vectors designed by [Freepik](https://www.freepik.com/)
