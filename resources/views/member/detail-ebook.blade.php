@extends('../templates/base')

@section('title', 'Daftar Buku')

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
                <div class="col-12">
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb position-relative">
                            <div class="breadcrumb-title position-absolute top-absolute text-center text-white">DETAIL EBOOK</div>
                            <li class="breadcrumb-item active" aria-current="page">Member</li>
                            <li class="breadcrumb-item"><a href="{{asset('/member/ebook')}}">Ebook</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            <li class="breadcrumb-item"><a href="{{asset('/member/ebook')}}">10</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row mt-3 justify-content-center detail pb-3 border-bottom">
                <div class="col-lg-4 col-md-6 col-11">
                    <img src="{{asset('img/coba3.jpg')}}" alt="" class="full-width fit-cover-top mb-3">
                </div>
                <div class="col-lg-6 col-md-6 col-11">
                    <div class="detail-wrapper position-relative">
                        <div class="gray-line position-absolute top-absolute full-width pt-1"></div>
                        <h1 class="judul border-bottom py-3 px-2">ini judul yang akan tertera disini</h1>
                        <h5 class="kategori"><span class="badge badge-secondary px-3 ml-2">Komputer dan Internet</span></h5>
                        <div class="profile-buku pl-2 my-4 border-bottom">
                            <p class="profile">Diterbitkan oleh Ini nama penerbit</p>
                            <p class="profile">Ditulis oleh ini nama penulis</p>
                        </div>
                        <p class="tentang text-justify pl-2 pr-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias laboriosam rem vel provident, neque doloribus, atque harum commodi blanditiis facere est nobis voluptatum corporis officiis natus dolores totam dolorem. Maiores.</p>
                        
                        <div class="btn-ajuan-wrapper ml-2">
                            <button type="button" class="btn btn-sm btn-ajuan mt-3 px-3 rounded-0 text-white mb-3" data-toggle="modal" data-target="#ajuanModal"><span>Ajukan Penggunaan Ebook</span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="full-width">
                <div class="ibsn-buku px-3 py-2 text-center text-white mb-4">
                    ISBN : 002-30-0201-010
                </div>
            </div>
        </div>

        <footer class="text-center p-2 text-white full-width mt-2">
            SMK Negeri 1 Cimahi &copy; 2020
        </footer>
    </div>

    <!-- Ajuan Modal -->
    <div class="modal modal-admin fade" id="ajuanModal" tabindex="-1" aria-labelledby="editDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <h5>PENGAJUAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-4">
                    <form>
                        <div class="form-group">
                          <small>Alasan pengajuan</small>
                          <textarea class="form-control" placeholder="Masukkan disini" rows="3"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm mb-2 px-5 btn-primary rounded-0">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
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
                    <a href="#" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>
@endsection