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
                <div class="gray-wrapper radius-admin mt-5 mt--5">
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
                <div class="gray-wrapper radius-admin px-4 position-relative mt-5 mt--5">
                    <div class="line-config position-absolute top-absolute full-width"></div>
                    <form action="{{url('/config/return-config')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p class="config-title">KONFIGURASI PENGEMBALIAN</p>
                            </div>
                            <div class="col-1 text-center px-0 m-0"><i class="far fa-clock"></i></div>
                            <div class="col-4 config-head px-1">
                                Batas Pengembalian
                            </div>
                            <div class="col-7">
                                <input type="number" class="form-control form-control-sm input-admin @error('batas_kembali') is-invalid @enderror" id="exampleInputPassword1" autocomplete="off" placeholder="Masukkan disini" name="batas_kembali" value="{{$data->loan_deadline}}">
                                @error('batas_kembali')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
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
                                    <input type="number" class="form-control input-admin @error('denda') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" name="denda" value="{{$data->late_charge}}">
                                </div>
                                @error('denda')
                                    <div class="invalid-feedback-input-group">
                                        {{$message}}
                                    </div>
                                @enderror
                                <small class="mb-3" style="color: gray">Masukkan nilai dengan format tanpa menggunakan titik atau koma, ex. 3000. Denda berlaku untuk keterlambatan /hari/buku</small>
                            </div>
                            <div class="col-12 text-right mt-2">
                                <button type="submit" class="btn btn-sm btn-success px-5">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="gray-wrapper radius-admin px-4 mt-4 position-relative">
                    <div class="line-config position-absolute top-absolute full-width"></div>
                    <form action="{{url('/config/data-list-config')}}" method="POST">
                        @csrf
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
                                    <input type="number" class="form-control input-admin @error('book_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->book_list_page}}" name="book_list" @if(auth()->user()->role == "Admin") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('book_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-user"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Anggota
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin @error('member_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->member_list_page}}" name="member_list" @if(auth()->user()->role == "Admin") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('member_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-user-tie"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Librarian
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin @error('librarian_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->librarian_list_page}}" name="librarian_list" @if(auth()->user()->role == "Pustakawan") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('librarian_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-book"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Ebook
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin @error('ebook_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->ebook_list_page}}" name="ebook_list" @if(auth()->user()->role == "Admin") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('ebook_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-upload"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Penerbit
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin @error('publisher_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->publisher_list_page}}" name="publisher_list" @if(auth()->user()->role == "Admin") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('publisher_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="far fa-bookmark"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Kategori
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin @error('category_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->category_list_page}}" name="category_list" @if(auth()->user()->role == "Admin") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('category_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-comment-alt"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Pengajuan
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin @error('permission_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->permission_list_page}}" name="permission_list" @if(auth()->user()->role == "Admin") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('permission_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-retweet"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Transaksi
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm mb-3">
                                    <input type="number" class="form-control input-admin @error('transaction_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->transaction_list_page}}" name="transaction_list" @if(auth()->user()->role == "Admin") readonly  @endif>
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('transaction_list')
                                    <div class="invalid-feedback-input-group" style="margin-top: -15px">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-1 text-center px-0 m-0 mt-2"><i class="fas fa-clipboard"></i></div>
                            <div class="col-4 config-head mt-2 px-1">
                                Data Laporan
                            </div>
                            <div class="col-7 mt-2">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control input-admin @error('report_list') is-invalid @enderror" autocomplete="off" placeholder="Masukkan disini" value="{{$data->report_list_page}}" name="report_list">
                                    <div class="input-group-append">
                                      <span class="input-group-text px-3 text-white input-grup-text-config">per Halaman</span>
                                    </div>
                                </div>
                                @error('report_list')
                                    <div class="invalid-feedback-input-group">
                                        {{$message}}
                                    </div>
                                @enderror
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
                <div class="modal-body text-center m-0 py-3 text-center" style="overflow-x: hidden">
                    <form action="{{url('/config/gallery')}}" method="POST" class="m-auto" style="width: 98%;" style="overflow-x: hidden" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-1/'.$gallery[0]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-1">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-1').src = window.URL.createObjectURL(this.files[0])" name="gallery_1">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-2/'.$gallery[1]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-2">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-2').src = window.URL.createObjectURL(this.files[0])" name="gallery_2">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-3/'.$gallery[2]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-3').src = window.URL.createObjectURL(this.files[0])" name="gallery_3">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-4/'.$gallery[3]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-4">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-4').src = window.URL.createObjectURL(this.files[0])" name="gallery_4">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-5/'.$gallery[4]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-5">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-5').src = window.URL.createObjectURL(this.files[0])" name="gallery_5">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-6/'.$gallery[5]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-6').src = window.URL.createObjectURL(this.files[0])" name="gallery_6">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-7/'.$gallery[6]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-7">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-7').src = window.URL.createObjectURL(this.files[0])" name="gallery_7">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-8/'.$gallery[7]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-8">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-8').src = window.URL.createObjectURL(this.files[0])" name="gallery_8">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-9/'.$gallery[8]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-9">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-9').src = window.URL.createObjectURL(this.files[0])" name="gallery_9">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-10/'.$gallery[9]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-10">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-10').src = window.URL.createObjectURL(this.files[0])" name="gallery_10">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-11/'.$gallery[10]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-11">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-11').src = window.URL.createObjectURL(this.files[0])" name="gallery_11">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-12/'.$gallery[11]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-12').src = window.URL.createObjectURL(this.files[0])" name="gallery_12">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-13/'.$gallery[12]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-13">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-13').src = window.URL.createObjectURL(this.files[0])" name="gallery_13">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-14/'.$gallery[13]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-14">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-14').src = window.URL.createObjectURL(this.files[0])" name="gallery_14">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-15/'.$gallery[14]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-15">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-15').src = window.URL.createObjectURL(this.files[0])" name="gallery_15">
                                      <label class="custom-file-label text-left" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <img src="{{asset('img/galleries/gallery-16/'.$gallery[15]->gallery_picture)}}" alt="Gallery" class="preview-gallery full-width fit-cover mb-2" id="gallery-16">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="document.getElementById('gallery-16').src = window.URL.createObjectURL(this.files[0])" name="gallery_16">
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
                    @error('file')
                        <div class="invalid-feedback-input-group">
                            {{$message}}
                        </div>
                    @enderror
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-3 text-center">
                    <form action="{{url('/config/member-bg')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="preview-bg position-relative">
                            <img src="{{asset('img/bg/'.$data->bg_member)}}" class="full-width fit-cover" id="preview-bg" alt="Gambar">
                            <div class="input-bg position-absolute text-white">
                                <div class="input-group input-group-sm shadow">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" onchange="document.getElementById('preview-bg').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name" name="file">
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