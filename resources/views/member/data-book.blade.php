@extends('../templates/base')

@section('title', 'Dasboard')

@section('content')
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
                                <a class="dropdown-item mb-2" href="#"><i class="fas fa-book mr-3"></i>Daftar Buku</a>
                                <a class="dropdown-item mb-2" href="#"><i class="fas fa-book mr-3"></i>Daftar Ebook</a>
                            </div>
                            <div class="profile">
                                <a class="dropdown-item mb-2" href="#"><i class="fas fa-user-alt mr-3"></i>Edit Profil Saya</a>
                                <a class="dropdown-item mb-2" href="#"><i class="fas fa-key mr-3"></i>Ganti Password</a>
                            </div>
                        </div>
                        <div class="logout">
                            <button class="btn btn-sm btn-danger btn-logout" data-toggle="modal" data-target="#logoutModal">Logout</button>
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm btn-notif text-white ml-1"><i class="fas fa-bell"></i></button>
            </div>
        </nav>

        <div class="container data-content">
            <div class="row">
                <div class="col-lg-9 col-md-7 col-12">
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb position-relative">
                            <div class="breadcrumb-title position-absolute top-absolute text-center text-white">DATA BUKU</div>
                            <li class="breadcrumb-item active" aria-current="page">Member</li>
                            <li class="breadcrumb-item"><a href="#">Book</a></li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-12">
                    <div class="form-search">
                        <form action="">
                            <div class="input-group full-width">
                                <input type="text" class="form-control pl-3" placeholder="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-success pr-3" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3 justify-content-center">
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-10 mb-4">
                    <div class="card card-book" style="width: 100%;">
                        <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
                        <div class="card-body position-relative">
                          <h5 class="judul-buku">ini judul buku yang tertera</h5>
                          <div class="btn-wrapper position-absolute">
                            <a href="#" class="btn text-white rounded-0 px-4">
                                <span>Detail Buku</span>
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center p-2 text-white full-width mt-2">
            SMK Negeri 1 Cimahi &copy; 2020
        </footer>
    </div>

    <a href="{{asset('/member/book')}}" class="btn see-all-btn position-fixed text-white py-2 px-4" title="Lihat Semua">
        <i class="fas fa-eye"></i>
    </a>

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
@endsection