@extends('../templates/admin')

@section('title', 'Data Transaksi')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/transaction') }}">Transaction</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4 p-0">
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
                                    <option>Nama</option>
                                    <option>Role</option>
                                    <option>Alamat</option>
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
                    <a href="{{ url('/transaction') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <button type="button" class="btn btn-success full-width" data-toggle="modal" data-target="#addDataModal"><i class="fas fa-plus"></i> Tambah Data</button>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Data Transaksi</h1>
                <div class="transaction-item-wrapper position-relative shadow mb-3">
                    <div class="transaction-item position-absolute full-width py-2">
                        <div class="container-fluid full-height position-relative">
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="id-transaksi py-2">Id Transaksi : 1</h1>
                                    <p class="person">0024633245 / Ilham Shiddiq</p>
                                    <div class="info">
                                        <p class="info-transaksi d-inline-block">Jumlah pinjam : <span class="badge badge-secondary mt-2">2 buku</span> , </p>
                                        <p class="info-transaksi d-inline-block">Jumlah kembali : <span class="badge badge-success mt-2">0 buku</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper position-absolute bottom-absolute full-width pl-3">
                                <div class="container position-relative">
                                    <a href="{{url('/return-book')}}" class="btn btn-sm btn-purple position-absolute bottom-absolute text-right rounded-0" title="Pengembalian"><i class="fas fa-exchange-alt"></i></a>
                                    <button type="button" class="btn btn-sm btn-info position-absolute bottom-absolute text-right rounded-0" title="Info" data-toggle="modal" data-target="#detailDataModal"><i class="fas fa-info-circle"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger position-absolute bottom-absolute text-right rounded-0" title="Hapus" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-sm btn-success position-absolute bottom-absolute rounded-0" title="Edit" data-toggle="modal" data-target="#editDataModal"><i class="fas fa-edit"></i></button>
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
                                    <h1 class="id-transaksi py-2">Id Transaksi : 1</h1>
                                    <p class="person">0024633245 / Ilham Shiddiq</p>
                                    <div class="info">
                                        <p class="info-transaksi d-inline-block">Jumlah pinjam : <span class="badge badge-secondary mt-2">2 buku</span> , </p>
                                        <p class="info-transaksi d-inline-block">Jumlah kembali : <span class="badge badge-success mt-2">0 buku</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper position-absolute bottom-absolute full-width pl-3">
                                <div class="container position-relative">
                                    <button type="button" class="btn btn-sm btn-purple position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-exchange-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-info position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-info-circle"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-sm btn-success position-absolute bottom-absolute rounded-0"><i class="fas fa-edit"></i></button>
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
                                    <h1 class="id-transaksi py-2">Id Transaksi : 1</h1>
                                    <p class="person">0024633245 / Ilham Shiddiq</p>
                                    <div class="info">
                                        <p class="info-transaksi d-inline-block">Jumlah pinjam : <span class="badge badge-secondary mt-2">2 buku</span> , </p>
                                        <p class="info-transaksi d-inline-block">Jumlah kembali : <span class="badge badge-success mt-2">0 buku</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper position-absolute bottom-absolute full-width pl-3">
                                <div class="container position-relative">
                                    <button type="button" class="btn btn-sm btn-purple position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-exchange-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-info position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-info-circle"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-sm btn-success position-absolute bottom-absolute rounded-0"><i class="fas fa-edit"></i></button>
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
                                    <h1 class="id-transaksi py-2">Id Transaksi : 1</h1>
                                    <p class="person">0024633245 / Ilham Shiddiq</p>
                                    <div class="info">
                                        <p class="info-transaksi d-inline-block">Jumlah pinjam : <span class="badge badge-secondary mt-2">2 buku</span> , </p>
                                        <p class="info-transaksi d-inline-block">Jumlah kembali : <span class="badge badge-success mt-2">0 buku</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper position-absolute bottom-absolute full-width pl-3">
                                <div class="container position-relative">
                                    <button type="button" class="btn btn-sm btn-purple position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-exchange-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-info position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-info-circle"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-sm btn-success position-absolute bottom-absolute rounded-0"><i class="fas fa-edit"></i></button>
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
                                    <h1 class="id-transaksi py-2">Id Transaksi : 1</h1>
                                    <p class="person">0024633245 / Ilham Shiddiq</p>
                                    <div class="info">
                                        <p class="info-transaksi d-inline-block">Jumlah pinjam : <span class="badge badge-secondary mt-2">2 buku</span> , </p>
                                        <p class="info-transaksi d-inline-block">Jumlah kembali : <span class="badge badge-success mt-2">0 buku</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper position-absolute bottom-absolute full-width pl-3">
                                <div class="container position-relative">
                                    <button type="button" class="btn btn-sm btn-purple position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-exchange-alt"></i></button>
                                    <button type="button" class="btn btn-sm btn-info position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-info-circle"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger position-absolute bottom-absolute text-right rounded-0"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-sm btn-success position-absolute bottom-absolute rounded-0"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Data Modal -->
    <div class="modal modal-admin fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <h5>TAMBAH DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form>
                        <div class="row">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="nameLibrarian">Nama Pustakawan (Librarian in charge)</small>
                                <input type="text" class="form-control" id="nameLibrarian" name="nameLibrarian" placeholder="Isikan disini..." readonly>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="nomorIndukLibrarian">NIP</small>
                                <input type="text" class="form-control" id="nomorIndukLibrarian" name="nomorIndukLibrarian" placeholder="Isikan disini..." readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-6">
                            <small for="nomorIndukMember">NIS/NIP Anggota</small>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="nomorIndukMember" name="nomorIndukMember" placeholder="Isikan disini...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm-text px-2" id="cekAnggota"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="namaMember">Nama Anggota</small>
                                <input type="text" class="form-control" id="namaMember" name="namaMember" placeholder="Isikan disini..." readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3 py-2 gray-bg gray-bg-transaction">
                            <div class="col-12 text-center">
                                <small>Jumlah buku dipinjam</small>
                            </div>
                            <div class="col-6 text-right pr-1">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jumlahPinjam" id="satuBuku" value="Guru" checked>
                                <label class="form-check-label" for="satuBuku">1 Buku</label>
                              </div>
                            </div>
                            <div class="col-6 pl-1">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jumlahPinjam" id="duaBuku" value="Siswa">
                                <label class="form-check-label" for="duaBuku">2 Buku</label>
                              </div>
                            </div>
                          </div>
                        <div class="row form-mg">
                            <div class="col-6">
                                <div class="form-group">
                                    <small for="idBukuPertama">ID Buku</small>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="idBukuPertama" name="idBukuPertama" placeholder="Isikan disini...">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm-text px-2" id="cekBukuPertama"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <small for="judulBukuPertama">Judul Buku</small>
                                    <input type="text" class="form-control" id="judulBukuPertama" name="judulBukuPertama" placeholder="Isikan disini..." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row form-mg d-none" id="row-buku-dua">
                            <div class="col-6 d-inline-block">
                                <div class="form-group">
                                    <small for="idBukuKedua">ID Buku kedua</small>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="idBukuKedua" name="idBukuKedua" placeholder="Isikan disini...">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary mb-1 btn-sm-text px-2 full-height" id="cekBukuKedua"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pl-1 d-inline-block">
                                <div class="form-group">
                                    <small for="judulBukuKedua">Judul Buku kedua</small>
                                    <input type="text" class="form-control" id="judulBukuKedua" name="judulBukuKedua" placeholder="Isikan disini..." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-12 text-center px-1">
                            <button type="submit" class="btn btn-primary mt-3 px-5" name="tambahData">Tambah Data</button>
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

    <!-- Edit Data Modal -->
    <div class="modal modal-admin fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <h5>EDIT DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                  <form>
                    <div class="row form-mg">
                        <div class="col-5 pr-1">
                            <div class="form-group">
                                <small for="idBukuPertamaEdit">ID Buku</small>
                                <input type="text" class="form-control" id="idBukuPertamaEdit" name="idBukuPertamaEdit" placeholder="Isikan disini...">
                            </div>
                          </div>
                          <div class="col-1 pl-1">
                              <button class="btn btn-primary mt-4 btn-sm-text px-2" id="cekBukuPertamaEdit"><i class="fas fa-search"></i></button>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="judulBukuPertamaEdit">Judul Buku</small>
                                <input type="text" class="form-control" id="judulBukuPertamaEdit" name="judulBukuPertamaEdit" placeholder="Isikan disini..." readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row form-mg" id="row-buku-dua-detail">
                        <div class="col-5 pr-1">
                            <div class="form-group">
                                <small for="idBukuKeduaEdit">ID Buku kedua</small>
                                <input type="text" class="form-control" id="idBukuKeduaEdit" name="idBukuKeduaEdit" placeholder="Isikan disini...">
                            </div>
                          </div>
                          <div class="col-1 pl-1">
                              <button class="btn btn-primary mt-4 btn-sm-text px-2" id="cekBukuKeduaEdit"><i class="fas fa-search"></i></button>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="judulBukuKeduaEdit" >Judul Buku Kedua</small>
                                <input type="text" class="form-control" id="judulBukuPertamaEdit" name="judulBukuKeduaEdit" placeholder="Isikan disini..." readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12 text-center px-1">
                        <button type="submit" class="btn btn-success mt-3 px-5" name="editData">Edit Data</button>
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
    
    <!-- Hapus Modal -->
    <div class="modal modal-admin fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title py-2" id="exampleModalLabel">PLEASE CONFIRM..</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-3 text-center">
                    <h2>Yakin ingin Menghapus Data?</h2>
                    <p class="pt-2">Data yang dihapus tidak akan bisa<br>dipulihkan kembali.</p>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Data Modal -->
    <div class="modal modal-admin fade" id="detailDataModal" tabindex="-1" aria-labelledby="detailDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="detail">
                                    <h1 class="detail-nama text-center">ID TRANSAKSI : 1</h1>
                                    <p class="detail detail-username text-center mb-3">NIS/NIP : 0024633245</p>
                                </div>
                            </div>
                        </div>
                        <div class="row form-mg">
                            <div class="col-6 pr-1">
                                <div class="form-group">
                                    <small for="idBukuPertamaDetail">ID Buku</small>
                                    <input type="text" class="form-control" id="idBukuPertamaDetail" name="idBukuPertamaDetail" placeholder="Isikan disini..." readonly>
                                </div>
                              </div>
                              <div class="col-6 pl-1">
                                <div class="form-group">
                                    <small for="judulBukuPertamaDetail">Judul Buku</small>
                                    <input type="text" class="form-control" id="judulBukuPertamaDetail" name="judulBukuPertamaDetail" placeholder="Isikan disini..." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row form-mg" id="detail-row-buku-dua">
                            <div class="col-6 pr-1">
                                <div class="form-group">
                                    <small for="idBukuKeduaDetail">ID Buku kedua</small>
                                    <input type="text" class="form-control" id="idBukuKeduaDetail" name="idBukuKeduaDetail" placeholder="Isikan disini..." readonly>
                                </div>
                              </div>
                              <div class="col-6 pl-1">
                                <div class="form-group">
                                    <small for="judulBukuKeduaDetail">Judul Buku kedua</small>
                                    <input type="text" class="form-control" id="judulBukuKeduaDetail" name="judulBukuKeduaDetail" placeholder="Isikan disini..." readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script src="js/transaction-modal.js"></script>
@endsection