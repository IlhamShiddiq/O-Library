@extends('../templates/admin')

@section('title', 'Laporan')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/report') }}">Report</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/report/late') }}">Late</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4 p-0">
                <div class="gray-wrapper mt-5 text-center font-weight-bold radius-admin month-report-info">
                    Data Laporan Bulan July
                </div>
                <div class="gray-wrapper radius-admin mt-5">
                    <div class="info-login-pic text-center border-bottom pb-2">
                        <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="70" height="70">
                    </div>
                    <div class="info-login text-center pt-1">
                        <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                        <span class="badge badge-success">{{auth()->user()->role}}</span>
                    </div>
                </div>
                <div class="gray-wrapper radius-admin">
                    <form>
                        <div class="form-row">
                          <div class="col-4">
                            <div class="form-group">
                                <select class="form-control">
                                    <option>All</option>
                                    <option>NIS/NIP</option>
                                    <option>Tanggal Kembali</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                          </div>
                        </div>
                    </form>
                    <a href="{{ url('/report') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Laporan</h1>
                <div class="transaction-item-wrapper position-relative shadow mb-3">
                    <div class="transaction-item position-absolute full-width py-2">
                        <div class="container-fluid full-height position-relative">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="id-transaksi py-2">Laporan ke-1</h1>
                                    <p class="person"><span class="badge badge-info">0024633245 / Ilham Shiddiq</span></p>
                                    <div class="info">
                                        <div class="info-book">
                                            <p class="info-transaksi">"Ini adalah judul buku dari buku yang dipinjam"</p>
                                        </div>
                                        <div class="info-date">
                                            <p class="info-transaksi d-inline-block">Tanggal pinjam : <span class="badge badge-secondary mt-2">2020/01/01</span> , </p>
                                            <p class="info-transaksi d-inline-block">Tanggal kembali : <span class="badge badge-success mt-2">2020/02/02</span></p>
                                        </div>
                                        <div class="info-late">
                                            <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-danger mt-2">Yes</span></p> ,
                                            <p class="info-transaksi d-inline-block">denda : Rp 3000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction-item-wrapper position-relative shadow mb-3">
                    <div class="transaction-item position-absolute full-width py-2">
                        <div class="container-fluid full-height position-relative">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="id-transaksi py-2">Laporan ke-1</h1>
                                    <p class="person"><span class="badge badge-info">0024633245 / Ilham Shiddiq</span></p>
                                    <div class="info">
                                        <div class="info-book">
                                            <p class="info-transaksi">"Ini adalah judul buku dari buku yang dipinjam"</p>
                                        </div>
                                        <div class="info-date">
                                            <p class="info-transaksi d-inline-block">Tanggal pinjam : <span class="badge badge-secondary mt-2">2020/01/01</span> , </p>
                                            <p class="info-transaksi d-inline-block">Tanggal kembali : <span class="badge badge-success mt-2">2020/02/02</span></p>
                                        </div>
                                        <div class="info-late">
                                            <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-danger mt-2">Yes</span></p> ,
                                            <p class="info-transaksi d-inline-block">denda : Rp 3000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction-item-wrapper position-relative shadow mb-3">
                    <div class="transaction-item position-absolute full-width py-2">
                        <div class="container-fluid full-height position-relative">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="id-transaksi py-2">Laporan ke-1</h1>
                                    <p class="person"><span class="badge badge-info">0024633245 / Ilham Shiddiq</span></p>
                                    <div class="info">
                                        <div class="info-book">
                                            <p class="info-transaksi">"Ini adalah judul buku dari buku yang dipinjam"</p>
                                        </div>
                                        <div class="info-date">
                                            <p class="info-transaksi d-inline-block">Tanggal pinjam : <span class="badge badge-secondary mt-2">2020/01/01</span> , </p>
                                            <p class="info-transaksi d-inline-block">Tanggal kembali : <span class="badge badge-success mt-2">2020/02/02</span></p>
                                        </div>
                                        <div class="info-late">
                                            <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-danger mt-2">Yes</span></p> ,
                                            <p class="info-transaksi d-inline-block">denda : Rp 3000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction-item-wrapper position-relative shadow mb-3">
                    <div class="transaction-item position-absolute full-width py-2">
                        <div class="container-fluid full-height position-relative">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="id-transaksi py-2">Laporan ke-1</h1>
                                    <p class="person"><span class="badge badge-info">0024633245 / Ilham Shiddiq</span></p>
                                    <div class="info">
                                        <div class="info-book">
                                            <p class="info-transaksi">"Ini adalah judul buku dari buku yang dipinjam"</p>
                                        </div>
                                        <div class="info-date">
                                            <p class="info-transaksi d-inline-block">Tanggal pinjam : <span class="badge badge-secondary mt-2">2020/01/01</span> , </p>
                                            <p class="info-transaksi d-inline-block">Tanggal kembali : <span class="badge badge-success mt-2">2020/02/02</span></p>
                                        </div>
                                        <div class="info-late">
                                            <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-danger mt-2">Yes</span></p> ,
                                            <p class="info-transaksi d-inline-block">denda : Rp 3000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction-item-wrapper position-relative shadow mb-3">
                    <div class="transaction-item position-absolute full-width py-2">
                        <div class="container-fluid full-height position-relative">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="id-transaksi py-2">Laporan ke-1</h1>
                                    <p class="person"><span class="badge badge-info">0024633245 / Ilham Shiddiq</span></p>
                                    <div class="info">
                                        <div class="info-book">
                                            <p class="info-transaksi">"Ini adalah judul buku dari buku yang dipinjam"</p>
                                        </div>
                                        <div class="info-date">
                                            <p class="info-transaksi d-inline-block">Tanggal pinjam : <span class="badge badge-secondary mt-2">2020/01/01</span> , </p>
                                            <p class="info-transaksi d-inline-block">Tanggal kembali : <span class="badge badge-success mt-2">2020/02/02</span></p>
                                        </div>
                                        <div class="info-late">
                                            <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-danger mt-2">Yes</span></p> ,
                                            <p class="info-transaksi d-inline-block">denda : Rp 3000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection