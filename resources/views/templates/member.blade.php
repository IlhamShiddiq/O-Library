<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/font.css')}}">

        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

        <title>@yield('title')</title>
    </head>
    <body>
        @if (session('success'))
            <div class="message message-success message-member position-absolute shadow">
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
            <div class="message message-danger message-member position-absolute shadow">
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
        
        <div class="member-page-data full-height">
            <nav class="navbar nav-member navbar-expand-lg py-2 px-5">
                <a href="{{url('/member/dashboard')}}" class="icon-nav p-1 rounded-circle my-1"><img src="{{asset('img/icon.png')}}" alt="admin icon" width="33" height="33" class="d-inline rounded-circle fit-cover"></a>
                <div class="profile ml-auto">
                    <img src="{{asset('uploaded_files/member-foto/'.auth()->user()->profile_photo_path)}}" alt="admin icon" width="35" height="35" class="d-inline rounded-circle fit-cover">
                    <div class="dropdown d-inline">
                        <button class="btn-admin text-white ml-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-member" aria-labelledby="dropdownMenuButton">
                            <div class="short-profile mb-2 text-center">
                                <img src="{{asset('uploaded_files/member-foto/'.auth()->user()->profile_photo_path)}}" alt="admin icon" width="33" height="33" class="d-inline rounded-circle fit-cover">
                                <p class="d-inline ml-2 name">{{auth()->user()->name}}</p>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="menu-link">
                                            <a class="dropdown-item mb-2" href="{{asset('/member/book')}}"><i class="fas fa-book mr-3"></i>Daftar Buku</a>
                                            <a class="dropdown-item mb-2" href="{{asset('/member/ebook')}}"><i class="fas fa-book mr-3"></i>Daftar Ebook</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="profile">
                                            <a class="dropdown-item mb-2" href="{{asset('/member/edit-profile')}}"><i class="fas fa-user-alt mr-3"></i>Edit Profil Saya</a>
                                            <a class="dropdown-item mb-2" href="{{asset('/member/change-password')}}"><i class="fas fa-key mr-3"></i>Ganti Password</a>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="logout">
                                <button class="btn btn-sm btn-danger btn-logout" data-toggle="modal" data-target="#logoutModal">Logout</button>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/member/my-ebook')}}" class="btn btn-sm btn-notif text-white ml-1"><i class="fas fa-book"></i></a>
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
                @yield('pagination')
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
                        <form action="{{url('/logout')}}" method="post">
                            @csrf
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" href="{{url('/logout')}}" class="btn btn-danger">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <script src="{{asset('js/app.js')}}"></script>
        <script src="{{asset('js/font-awesome.js')}}"></script>
        <script src="{{asset('js/close-message-btn.js')}}"></script>
        @yield('more-js')
    </body>
</html>