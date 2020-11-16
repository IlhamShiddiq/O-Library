@extends('../templates/base')

@section('title', 'Dasboard')

@section('content')
    @if (session('success'))
        <div class="message message-success message-member-dashboard position-absolute shadow">
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

    <div class="member-page full-height">
        <img src="{{asset('img/bg/bg.jpg')}}" class="position-absolute top-absolute full-width full-height fit-cover">
        <div class="overlay-black position-absolute top-absolute full-width full-height "></div>
        
        <nav class="navbar nav-member navbar-expand-lg py-4 px-5">
            <a href="{{url('/member/dashboard')}}"><img src="{{asset('img/icon.png')}}" alt="admin icon" width="55" height="55" class="d-inline rounded-circle fit-cover"></a>
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
                <a href="{{asset('/member/my-ebook')}}" class="btn btn-sm btn-notif text-white ml-1"><i class="fas fa-book"></i></a>
                <button class="btn btn-sm btn-notif text-white ml-1"><i class="fas fa-bell"></i></button>
            </div>
        </nav>

        <div class="form-search full-width p-3">
            <div class="container">
                <div class="col-12 text-white title text-center mb-4">
                    <p class="main-title">PERPUSTAKAAN</p>
                    <p class="sub-title">Cari buku dan mulai membaca!</p>
                </div>
                <div class="col-12">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-left rounded-0 border-0" placeholder="Cari daftar buku berdasarkan ...." autocomplete="off">
                            <div class="input-group-append" id="button-addon4">
                                <select class="custom-select rounded-0 border-left" id="inputGroupSelect01">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <button class="btn btn-success rounded-0" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="text-center p-3 position-absolute bottom-absolute full-width">
            SMK Negeri 1 Cimahi &copy; 2020
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

    <script src="{{asset('js/close-message-btn.js')}}"></script>
@endsection