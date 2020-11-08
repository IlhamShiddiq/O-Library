@extends('../templates/admin')

@section('title', 'Data Ebook')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/ebook') }}">Ebook</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4 p-0">
                <div class="gray-wrapper radius-admin mt-5">
                    <div class="info-login-pic text-center border-bottom pb-2">
                        <img src="{{asset('img/photo.png')}}" alt="Ilham Shiddiq" class="rounded-circle" width="70">
                    </div>
                    <div class="info-login text-center pt-1">
                        <p class="m-1">Halo, ilhmshdq (Ilham Shiddiq)</p>
                        <span class="badge badge-success">Pustakawan</span>
                    </div>
                </div>
                <div class="gray-wrapper radius-admin">
                    <form>
                        <div class="form-row">
                          <div class="col-4">
                            <div class="form-group">
                                <select class="form-control">
                                    <option>All</option>
                                    <option>Judul</option>
                                    <option>Penerbit</option>
                                    <option>Penulis</option>
                                    <option>Kategori</option>
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
                    <a href="{{ url('/ebook') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <button type="button" class="btn btn-success full-width" data-toggle="modal" data-target="#addDataModal"><i class="fas fa-plus"></i> Tambah Data</button>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Data Ebook</h1>
                <div class="item-table item-buku shadow">
                    <div class="item-table-header top-absolute">
                        <h1 class="judul text-white">Ini Judul dari ebook</h1>
                    </div>
                    <div class="item-table-body">
                        <div class="row">
                            <div class="col-6 col-md-8 col-lg-8">
                                <span class="badge badge-secondary">Kategori</span>
                                <p class="about mt-2">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam recusandae voluptatum, ullam at, nihil minima ex dolorum culpa quae.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="image-buku">
                        <div class="image" style="background-image: url('img/coba.jpg')"></div>
                    </div>
                    <div class="btn-action bottom-absolute">
                        <a href="#" class="badge badge-success" data-toggle="modal" data-target="#editDataModal">Ubah</a>
                        <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal">Hapus</a>
                        <a href="{{url('/ebook/view')}}" class="badge badge-info">Buka ebook</a>
                    </div>
                    <div class="item-table-footer bottom-absolute">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 p-0">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#detailDataModal">Detail Ebook</button>
                                </div>
                                <div class="col-6 text-right p-0">
                                    <span class="badge badge-light mr-3 stok">Size : 9,8 mb</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-table item-buku shadow">
                    <div class="item-table-header top-absolute">
                        <h1 class="judul text-white">Ini Judul dari buku</h1>
                    </div>
                    <div class="item-table-body">
                        <div class="row">
                            <div class="col-6 col-md-8 col-lg-8">
                                <span class="badge badge-secondary">Kategori</span>
                                <p class="about mt-2">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam recusandae voluptatum, ullam at, nihil minima ex dolorum culpa quae.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="image-buku">
                        <div class="image" style="background-image: url('img/coba2.jpeg')"></div>
                    </div>
                    <div class="btn-action bottom-absolute">
                        <a href="#" class="badge badge-success">Ubah</a>
                        <a href="#" class="badge badge-danger">Hapus</a>
                        <a href="#" class="badge badge-info">Riwayat</a>
                    </div>
                    <div class="item-table-footer bottom-absolute">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 p-0">
                                    <button type="button" class="btn btn-dark">Detail Buku</button>
                                </div>
                                <div class="col-6 text-right p-0">
                                    <span class="badge badge-light mr-3 stok">Stok buku : 98</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-table item-buku shadow">
                    <div class="item-table-header top-absolute">
                        <h1 class="judul text-white">Ini Judul dari buku</h1>
                    </div>
                    <div class="item-table-body">
                        <div class="row">
                            <div class="col-6 col-md-8 col-lg-8">
                                <span class="badge badge-secondary">Kategori</span>
                                <p class="about mt-2">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam recusandae voluptatum, ullam at, nihil minima ex dolorum culpa quae.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="image-buku">
                        <div class="image" style="background-image: url('img/coba3.jpg')"></div>
                    </div>
                    <div class="btn-action bottom-absolute">
                        <a href="#" class="badge badge-success">Ubah</a>
                        <a href="#" class="badge badge-danger">Hapus</a>
                        <a href="#" class="badge badge-info">Riwayat</a>
                    </div>
                    <div class="item-table-footer bottom-absolute">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 p-0">
                                    <button type="button" class="btn btn-dark">Detail Buku</button>
                                </div>
                                <div class="col-6 text-right p-0">
                                    <span class="badge badge-light mr-3 stok">Stok buku : 98</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-table item-buku shadow">
                    <div class="item-table-header top-absolute">
                        <h1 class="judul text-white">Ini Judul dari buku</h1>
                    </div>
                    <div class="item-table-body">
                        <div class="row">
                            <div class="col-6 col-md-8 col-lg-8">
                                <span class="badge badge-secondary">Kategori</span>
                                <p class="about mt-2">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam recusandae voluptatum, ullam at, nihil minima ex dolorum culpa quae.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="image-buku">
                        <div class="image" style="background-image: url('img/coba4.jpeg')"></div>
                    </div>
                    <div class="btn-action bottom-absolute">
                        <a href="#" class="badge badge-success">Ubah</a>
                        <a href="#" class="badge badge-danger">Hapus</a>
                        <a href="#" class="badge badge-info">Riwayat</a>
                    </div>
                    <div class="item-table-footer bottom-absolute">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 p-0">
                                    <button type="button" class="btn btn-dark">Detail Buku</button>
                                </div>
                                <div class="col-6 text-right p-0">
                                    <span class="badge badge-light mr-3 stok">Stok buku : 98</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-table item-buku shadow">
                    <div class="item-table-header top-absolute">
                        <h1 class="judul text-white">Ini Judul dari buku</h1>
                    </div>
                    <div class="item-table-body">
                        <div class="row">
                            <div class="col-6 col-md-8 col-lg-8">
                                <span class="badge badge-secondary">Kategori</span>
                                <p class="about mt-2">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam recusandae voluptatum, ullam at, nihil minima ex dolorum culpa quae.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="image-buku">
                        <div class="image" style="background-image: url('img/coba5.jpg')"></div>
                    </div>
                    <div class="btn-action bottom-absolute">
                        <a href="#" class="badge badge-success">Ubah</a>
                        <a href="#" class="badge badge-danger">Hapus</a>
                        <a href="#" class="badge badge-info">Riwayat</a>
                    </div>
                    <div class="item-table-footer bottom-absolute">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 p-0">
                                    <button type="button" class="btn btn-dark">Detail Buku</button>
                                </div>
                                <div class="col-6 text-right p-0">
                                    <span class="badge badge-light mr-3 stok">Stok buku : 98</span>
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
                          <div class="col-12">
                            <div class="form-group">
                                <small for="judulEbook">Judul Ebook</small>
                                <input type="text" class="form-control" id="judulEbook" name="judulEbook" placeholder="Isikan disini...">
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="penerbitEbook">Penerbit Ebook</small>
                                <select class="form-control" id="penerbitEbook" name="penerbitEbook">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="penulisEbook">Kategori Ebook</small>
                                <select class="form-control" id="penulisEbook" name="penulisEbook">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-8 pr-1">
                            <div class="form-group">
                                <small for="judulEbook">Penulis Ebook</small>
                                <input type="text" class="form-control" id="judulEbook" name="judulEbook" placeholder="Isikan disini...">
                            </div>
                          </div>
                          <div class="col-4 pl-1">
                            <div class="form-group">
                                <small for="penulisEbook">Downloadable</small>
                                <select class="form-control" id="penulisEbook" name="penulisEbook">
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="tentangEbook">Tentang Ebook</small>
                                <textarea class="form-control" id="tentangEbook" name="tentangEbook" placeholder="Isikan disini..." rows="3"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                            <div class="col-12">
                              <small for="fileEbook">File Ebook</small>
                              <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileEbook" name="fileBEbook">
                                    <label class="custom-file-label" for="gambarEbook">Choose file</label>
                                  </div>
                              </div>
                            </div>
                          </div>
                        <div class="row">
                          <div class="col-12">
                            <small for="gambarEbook">Gambar Ebook</small>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="gambarEbook" name="gambarEbook">
                                  <label class="custom-file-label" for="gambarEbook">Choose file</label>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                          <div class="col-4 px-0">
                            <div class="preview-img" id="preview-img"></div>
                          </div>
                          <div class="col-8 text-black pt-3 px-1">
                            <small>Mohon diisi secara lengkap,<br>serta diisi dengan data yang sebenar-benarnya.</small>
                            <button type="submit" class="btn btn-sm btn-primary mt-3 px-5" name="tambahData">Tambah Data</button>
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
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="judulEbook">Judul Ebook</small>
                                <input type="text" class="form-control" id="judulEbook" name="judulEbook" placeholder="Isikan disini...">
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="penerbitEbook">Penerbit Ebook</small>
                                <select class="form-control" id="penerbitEbook" name="penerbitEbook">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="penulisEbook">Kategori Ebook</small>
                                <select class="form-control" id="penulisEbook" name="penulisEbook">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-8 pr-1">
                            <div class="form-group">
                                <small for="judulEbook">Penulis Ebook</small>
                                <input type="text" class="form-control" id="judulEbook" name="judulEbook" placeholder="Isikan disini...">
                            </div>
                          </div>
                          <div class="col-4 pl-1">
                            <div class="form-group">
                                <small for="penulisEbook">Downloadable</small>
                                <select class="form-control" id="penulisEbook" name="penulisEbook">
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="tentangEbook">Tentang Ebook</small>
                                <textarea class="form-control" id="tentangEbook" name="tentangEbook" placeholder="Isikan disini..." rows="3"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                            <div class="col-12">
                              <small for="fileEbook">File Ebook</small>
                              <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileEbook" name="fileBEbook">
                                    <label class="custom-file-label" for="gambarEbook">Choose file</label>
                                  </div>
                              </div>
                            </div>
                          </div>
                        <div class="row">
                          <div class="col-12">
                            <small for="gambarEbook">Gambar Ebook</small>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="gambarEbook" name="gambarEbook">
                                  <label class="custom-file-label" for="gambarEbook">Choose file</label>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                          <div class="col-4 px-0">
                            <div class="preview-img" id="preview-img"></div>
                          </div>
                          <div class="col-8 text-black pt-3 px-1">
                            <small>Mohon diisi secara lengkap,<br>serta diisi dengan data yang sebenar-benarnya.</small>
                            <button type="submit" class="btn btn-sm btn-success mt-3 px-5" name="editData">Edit Data</button>
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
                            <div class="col-3">
                                <div class="image-buku">

                                </div>
                            </div>
                            <div class="col-9">
                                <div class="detail">
                                    <h1 class="detail-judul">Ini Judul Ebook</h1>
                                    <span class="badge badge-secondary detail-kategori mb-2">Kategori</span>
                                    <p class="detail detail-penulis">Ditulis oleh : Ilham Shiddiq</p>
                                    <p class="detail detail-penerbit">Diterbitkan oleh : Ilham Shiddiq Publisher</p>
                                    <p class="detail detail-tentang">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam aspernatur est nisi dolorum vero! Assumenda necessitatibus unde commodi rem labore accusamus cum nobis minima obcaecati vel eos, dignissimos quia possimus.
                                    </p>
                                    <p class="detail detail-stok">Size : <span>89</span>mb</p>
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
@endsection