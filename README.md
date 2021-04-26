# O'Library
A web application for datas management system in library. Managing any datas like book, ebook, publisher, etc. Olibrary also a web that is used for member to check all book and ebook datas in library, with this web member can ask permission to read ebook(s). You can check this website [here](https://olibrary-smkn-1.herokuapp.com/)

## Installing Web Application
### 1. Sofware required
Before installing OLibrary, make sure your device has installed these softwares.
* Composer : you can download it [here](https://getcomposer.org/)
* NodeJS : you can download it [here](https://nodejs.org/en/)
### 2. Installing
* In your device, make a database named `olibrary` (MySQL DBMS)
* Download all files from this github repo, extract it and open the Command Prompt/Terminal (make sure the path is direct to the project)
* Run `composer install`
* Run `npm install`
* Run `php artisan key:generate`
* Run `php artisan migrate`
* Run `php artisan db:seed --class=ConfigsSeeder`
* Run `php artisan db:seed --class=AdminSeeder`
* Run `php artisan db:seed --class=LibrarianSeeder`
* Run `php artisan db:seed --class=MemberSeeder`
* Last, run `php artisan serve`, then open your browser with url address `http://127.0.0.1:8000/`

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

### Note
Please let me know, if youn find bugs in my website.


All vectors designed by [Freepik](https://www.freepik.com/)
