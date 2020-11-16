<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/font.css')}}">

        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

        <title>@yield('title')</title>
    </head>
    <body>
        <div class="member-page-data full-height">
            <nav class="navbar nav-member navbar-expand-lg py-2 px-5">
                <a href="{{url('/member/dashboard')}}" class="icon-nav p-1 rounded-circle my-1"><img src="{{asset('img/icon.png')}}" alt="admin icon" width="33" height="33" class="d-inline rounded-circle fit-cover"></a>
                <div class="profile ml-auto">
                    <img src="{{asset('img/photo.png')}}" alt="admin icon" width="35" height="35" class="d-inline rounded-circle fit-cover">
                    <div class="dropdown d-inline">
                        <button class="btn-admin text-white ml-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <div class="short-profile mb-2 text-center">
                                <img src="{{asset('img/photo.png')}}" alt="admin icon" width="33" height="33" class="d-inline rounded-circle fit-cover">
                                <p class="d-inline ml-2 name">Ilham Shiddiq</p>
                            </div>
                            <div class="container">
                                <div class="menu-link">
                                    <a class="dropdown-item mb-2" href="{{asset('/member/book')}}"><i class="fas fa-book mr-3"></i>Daftar Buku</a>
                                    <a class="dropdown-item mb-2" href="{{asset('/member/ebook')}}"><i class="fas fa-book mr-3"></i>Daftar Ebook</a>
                                </div>
                                <div class="profile">
                                    <a class="dropdown-item mb-2" href="{{asset('/member/edit-profile')}}"><i class="fas fa-user-alt mr-3"></i>Edit Profil Saya</a>
                                    <a class="dropdown-item mb-2" href="{{asset('/member/change-password')}}"><i class="fas fa-key mr-3"></i>Ganti Password</a>
                                </div>
                            </div>
                            <div class="logout">
                                <button class="btn btn-sm btn-danger btn-logout" data-toggle="modal" data-target="#logoutModal">Logout</button>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-notif text-white ml-1"><i class="fas fa-book"></i></a>
                    <button class="btn btn-sm btn-notif text-white ml-1"><i class="fas fa-bell"></i></button>
                </div>
            </nav>

            <div class="container data-content">
                <div class="row">
                    @yield('breadcrumb')
                </div>
                <div class="row justify-content-center mt-3">
                    @yield('content')
                </div>
                @yield('more-content')
            </div>

            <footer class="text-center p-2 text-white full-width mt-2">
                SMK Negeri 1 Cimahi &copy; 2020
            </footer>
        </div>

        @yield('more-modal')

        <!-- Logout Modal -->
        <div class="modal modal-admin fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title py-2" id="exampleModalLabel">PLEASE CONFIRM..</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center py-3 text-center">
                        <h2>Yakin ingin Logout?</h2>
                        <p class="pt-2">Anda harus mengisi form login lagi jika ingin<br>masuk kembali</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="#" class="btn btn-danger">Yes</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="{{asset('js/font-awesome.js')}}"></script>
        @yield('more-js')
    </body>
</html>