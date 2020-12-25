@extends('templates/admin')

@section('title', 'Config')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/config') }}">Config</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4 p-0">
                <div class="gray-wrapper radius-admin">
                    <div class="info-login-pic text-center border-bottom pb-2">
                        <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="70" height="70">
                    </div>
                    <div class="info-login text-center pt-1">
                        <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                        <span class="badge badge-success">{{auth()->user()->role}}</span>
                    </div>
                </div>
                <button class="btn btn-sm btn-success full-width" data-toggle="modal" data-target="#galleryModal">Gallery Configuration</button>
                <button class="btn btn-sm btn-success full-width mt-2 mb-3" data-toggle="modal" data-target="#dashboardMemberModal">Member Background Configuration</button>
            </div>
            <div class="col-12 col-md-12 col-lg-8 mb-3">
                <div class="gray-wrapper radius-admin px-4 position-relative">
                    <div class="line-config position-absolute top-absolute full-width"></div>
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <p class="config-title">KONFIGURASI PENGEMBALIAN</p>
                            </div>
                            <div class="col-1 text-center px-0 m-0"><i class="far fa-clock"></i></div>
                            <div class="col-4 config-head px-1">
                                Batas Pengembalian
                            </div>
                            <div class="col-7">
                                <input type="number" class="form-control form-control-sm input-admin" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan disini">
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-wallet"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Harga Denda
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">Rp</span>
                                    </div>
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                </div>
                                <small class="mb-3" style="color: gray">Masukkan nilai dengan format tanpa menggunakan titik atau koma, ex. 3000</small>
                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-sm btn-success px-5">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="gray-wrapper radius-admin px-4 mt-4 position-relative">
                    <div class="line-config position-absolute top-absolute full-width"></div>
                    <form action="">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <p class="config-title m-0">KONFIGURASI DATA PER HALAMAN</p><small style="color: gray">Konfigurasi hanya diterapkan untuk halaman pustakawan/admin saja</small>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-book"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Buku
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-user"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Anggota
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-user-tie"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Librarian
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-book"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Ebook
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-upload"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Penerbit
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="far fa-bookmark"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Kategori
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-comment-alt"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Pengajuan
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-retweet"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Transaksi
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-clipboard"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Laporan
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control input-admin" autocomplete="off" placeholder="Masukkan disini">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                <small class="mb-3" style="color: gray">Masukkan nilai dengan format tanpa menggunakan titik atau koma, ex. 10 (maks. 15)</small>
                            </div>
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-sm btn-success px-5">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri Modal -->
    <div class="modal modal-admin fade" id="galleryModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-lg modal-dialog-centered modal-dialog-scrollable p-0" style="overflow-x: hidden">
            <div class="modal-content p-0">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <h5 class="m-0">GALLERY CONFIGURATION</h5>
                    <small style="color: gray">Input gambar yang diizinkan hanya yang berekstensi .jpg. Disarankan dengan resolusi 500x500 pixel ke atas.</small>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center m-0 py-3 text-center">
                    <form class="m-auto" style="width: 98%;">
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-1.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-2.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-3.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-4.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-5.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-6.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-7.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-8.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-9.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-10.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-11.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-12.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-13.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-14.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-15.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-16.jpg')}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success px-5 my-0">Submit</button>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Member Modal -->
    <div class="modal modal-admin fade" id="dashboardMemberModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <h5 class="m-0">MEMBER BACKGROUND CONFIGURATION</h5>
                    <small style="color: gray">Input gambar yang diizinkan hanya yang berekstensi .jpg. Disarankan dengan resolusi 1366x768 pixel ke atas.</small>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-3 text-center">
                    <form action="">
                        <div class="preview-bg position-relative">
                            <img src="{{asset('img/bg/bg.jpg')}}" class="full-width fit-cover" id="preview-bg" alt="Gambar">
                            <div class="input-bg position-absolute text-white">
                                <div class="input-group input-group-sm shadow">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" onchange="document.getElementById('preview-bg').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                    </div>
                                    <div class="input-group-append">
                                      <button class="btn btn-success px-3" type="submit" id="inputGroupFileAddon04">Submit</button>
                                    </div>
                                </div>
                                <label class="custom-file-label text-left" id="name-label">Choose file</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>
@endsection