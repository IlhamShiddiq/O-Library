@extends('../templates/admin')

@section('title', 'History')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/member') }}">Member</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/member/history') }}">History</a></li>
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
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Member History</h1>
                <table class="table table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" style="width: 55px" class="text-center">#</th>
                      <th scope="col">Judul Buku</th>
                      <th style="width: 180px">Tanggal Pinjam</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ini adalah judul buku yang pernah dipinjam</td>
                        <td>2020/09/09</td>
                    </tr>
                  </tbody>
                </table>
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
                      <div class="col-7 pl-4 pr-1">
                        <div class="form-group">
                            <small for="penerbitBuku">Penerbit Buku</small>
                            <input type="text" class="form-control" id="penerbitBuku" name="penerbitBuku" placeholder="Isikan disini...">
                        </div>
                      </div>
                      <div class="col-5 pl-1 pr-4">
                        <button type="submit" class="btn btn-primary mt-4 full-width" name="tambahData">Tambah Data</button>
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
                      <div class="col-7 pl-4 pr-1">
                        <div class="form-group">
                            <small for="penerbitBuku">Penerbit Buku</small>
                            <input type="text" class="form-control" id="penerbitBuku" name="penerbitBuku" placeholder="Isikan disini...">
                        </div>
                      </div>
                      <div class="col-5 pl-1 pr-4">
                        <button type="submit" class="btn btn-success mt-4 full-width" name="tambahData">Edit Data</button>
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
@endsection