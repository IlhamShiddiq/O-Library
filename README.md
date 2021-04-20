# O'Library
A web application for datas management system in library. Managing any datas like book, ebook, publisher, etc. Olibrary also a web that is used for member to check all book and ebook datas in library, with this web member can ask permission to read ebook(s).

## Installing Web Application
### 1. Sofware required
Before installing OLibrary, make sure your device has installed these softwares.
* Composer : you can download it [here](https://getcomposer.org/)
* NodeJS : you can download it [here](https://nodejs.org/en/)
### 2. Installing
* In your device, make a database named `olibrary` (MySQL DBMS)
* Download all files from this github repo, extract it and open the Command Prompt/Terminal (make sure the path is direct to the project)
* Type `composer install`, and enter
* Type `npm install`, and enter
* Type `php artisan key:generate`, and enter
* Type `php artisan migrate`, and enter
* Type `php artisan db:seed --class=ConfigsSeeder`, and enter
* Type `php artisan db:seed --class=AdminSeeder`, and enter
* Type `php artisan db:seed --class=LibrarianSeeder`, and enter
* Type `php artisan db:seed --class=MemberSeeder`, and enter
* Last, type `php artisan serve`, then open your browser with url address `localhost:8000`

## Account
#### 1. Admin
* Username : haloadmin
* Password : haloadmin
#### 2. Pustakawan
* Username : halolibrarian
* Password : halolibrarian
#### 3. Member
* Username : halomember
* Password : halomember

## Built with
* [Laravel v 8](https://laravel.com/docs/8.x)
* [Bootstrap](https://getbootstrap.com/docs/4.5/getting-started/introduction/)


All vectors designed by [Freepik](https://www.freepik.com/)
