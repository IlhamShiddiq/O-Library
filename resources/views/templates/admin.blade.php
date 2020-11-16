<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/font.css')}}">
    @yield('more-css')

    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

    <title>@yield('title')</title>
  </head>
  <body>

    @if (session('success'))
        <div class="message message-success message-admin position-absolute shadow">
            <div class="message-header position-relative text-white rounded-top">
                <h6>Message!!</h6>
                <button class="btn position-absolute text-white" id="btn-close-message"><i class="fas fa-times"></i></button>
                <div class="triangle-up position-absolute"></div>
            </div>
            <div class="message-body">
                <p>{{session('success')}}</p>
            </div>
        </div>
    @endif

    @if (session('failed'))
        <div class="message message-danger message-admin position-absolute shadow">
            <div class="message-header position-relative text-white rounded-top">
                <h6>Message!!</h6>
                <button class="btn position-absolute text-white" id="btn-close-message"><i class="fas fa-times"></i></button>
                <div class="triangle-up position-absolute"></div>
            </div>
            <div class="message-body">
                <p>{{session('failed')}}</p>
            </div>
        </div>
    @endif

    <div class="page-admin dp-relative">
        <nav class="navbar nav-admin navbar-expand-lg nav-green">
            <button class="hamburger btn-admin text-white" id="hamburger"><i class="fas fa-bars"></i></button>
            <div class="profile ml-auto">
                <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="admin icon" width="43" height="43" class="d-inline rounded-circle fit-cover">
                <div class="dropdown d-inline">
                    <button class="btn-admin text-white ml-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-caret-down"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <div class="short-profile mb-2">
                            <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="admin icon" width="33" height="33" class="d-inline rounded-circle fit-cover">
                            <p class="d-inline ml-2 name">{{auth()->user()->username}}</p>
                        </div>
                        <a class="dropdown-item mb-2" href="{{url('/edit-profile')}}"><i class="fas fa-user-alt mr-3"></i>Edit Profil Saya</a>
                        <a class="dropdown-item mb-2" href="{{url('/change-password')}}"><i class="fas fa-key mr-3"></i>Ganti Password</a>
                        <div class="logout">
                            <button class="btn btn-sm btn-danger btn-logout" data-toggle="modal" data-target="#logoutModal">Logout</button>
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm btn-notif text-white ml-1"><i class="fas fa-bell"></i></button>
            </div>
        </nav>
        <div class="breadcrumb-container">
            @yield('breadcrumb')
        </div>
        <div class="konten">
            @yield('content')
        </div>
        <div class="menu top-absolute" id="menu">
            <div class="brand-menu dp-relative text-white text-center mb-2">
                <h1>O'LIBRARY</h1>
                <button class="close btn-admin text-white" id="close"><i class="fas fa-times"></i></button>
            </div>
            <div class="list-menu">
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-home"></i>
                    </div>
                    <a href="{{ url('/dashboard') }}" class="dest-item d-inline-block text-white">
                        Dashboard
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <a href="{{ url('/librarian') }}" class="dest-item d-inline-block text-white">
                        Data Pustakawan
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{ url('/book') }}" class="dest-item d-inline-block text-white">
                        Data Buku
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ url('/member') }}" class="dest-item d-inline-block text-white">
                        Data Anggota
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="{{ url('/ebook') }}" class="dest-item d-inline-block text-white">
                        Data Ebook
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-upload"></i>
                    </div>
                    <a href="{{ url('/publisher') }}" class="dest-item d-inline-block text-white">
                        Data Penerbit
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <a href="{{ url('/category') }}" class="dest-item d-inline-block text-white">
                        Data Kategori
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-comment-alt"></i>
                    </div>
                    <a href="{{ url('/permission') }}" class="dest-item d-inline-block text-white">
                        Pengajuan
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-retweet"></i>
                    </div>
                    <a href="{{ url('/transaction') }}" class="dest-item d-inline-block text-white">
                        Transaksi
                    </a>
                </div>
                <div class="item-menu text-white">
                    <div class="icon-item d-inline-block text-center">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <a href="{{ url('/report') }}" class="dest-item d-inline-block text-white">
                        Laporan
                    </a>
                </div>
            </div>
        </div>
        <div class="overlay top-absolute" id="overlay"></div>
        <footer class="ft-green bottom-absolute py-3 text-white text-center">
            <p>O'Library &copy; 2020, SMKN 1 Cimahi</p>
        </footer>
    </div>

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
                    <a href="{{url('/logout')}}" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/font-awesome.js')}}"></script>
    <script src="{{asset('js/close-message-btn.js')}}"></script>
    @yield('more-js')
  </body>
</html>