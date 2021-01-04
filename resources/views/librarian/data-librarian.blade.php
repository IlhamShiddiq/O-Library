@extends('../templates/admin')

@section('title', 'Data Pustakawan')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/librarian') }}">Librarian</a></li>
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
                    <form action="{{url('/librarian/search')}}" method="post">
                        @csrf
                        <div class="form-row">
                          <div class="col-4">
                            <div class="form-group">
                                <select class="form-control" name="by">
                                    <option value="name">Nama</option>
                                    <option value="role">Role</option>
                                    <option value="address">Alamat</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                          </div>
                        </div>
                    </form>
                    <a href="{{ url('/librarian') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <button type="button" class="btn btn-success full-width" data-toggle="modal" data-target="#addDataModal"><i class="fas fa-plus"></i> Tambah Data</button>
                </div>
                <div class="total-row text-center p-3 border-bottom mb-5">
                    {{$count}} Data Ditampilkan
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Data Pustakawan</h1>
                <div class="list-wrapper mb-4">
                    @foreach ($librarians as $librarian)
                        <?php
                            $red = '';
                            if(!($librarian->username)) {
                                $librarian->username = 'Not confirmed yet';
                                $red = "style='color: red; font-style: italic;'";
                            }
                        ?>
                        <div class="item-person p-2 position-relative mb-3 shadow">
                            <div class="photo-person-wrapper position-absolute bg-white p-1">
                                <div class="photo-person full-width">
                                    <img src="{{asset('uploaded_files/librarian-foto/'.$librarian->profile_photo_path)}}" alt="{{$librarian->name}}" class="full-width full-height fit-cover">
                                </div>
                            </div>
                            <div class="data-person">
                                <h1 class="name-person py-2 mt-2">
                                    {{$librarian->name}}
                                </h1>
                                <p class="username m-1" <?php if($red) echo $red; ?>>Username : {{$librarian->username}} ({{$librarian->role}})</p>
                                <p class="username">&nbsp;{{$librarian->nomor_induk}}</p>
                                <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$librarian->id}}">Hapus</a>
                                @if ($librarian->confirm_code != '')
                                    <a href="#" class="badge badge-success" data-toggle="modal" data-target="#resetKode" data-id="{{$librarian->id}}">Reset Kode</a>
                                @endif
                                <a href="#" class="badge badge-info" data-toggle="modal" data-target="#detailDataModal" data-name="{{$librarian->name}}" data-role="{{$librarian->role}}" data-username="{{$librarian->username}}" data-address="{{$librarian->address}}" data-phone="{{$librarian->phone}}" data-image="{{asset('uploaded_files/librarian-foto/'.$librarian->profile_photo_path)}}">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-btn position-relative mr-2">
                    {{ $librarians->links() }}
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
                    <form action="{{url('/librarian')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="nomorInduk">Nomor Induk</small>
                                <input type="text" class="form-control @error('nomorInduk') is-invalid @enderror" id="nomorInduk" name="nomorInduk" placeholder="Isikan disini...">
                                @error('nomorInduk')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="namaLibrarian">Nama Lengkap</small>
                                <input type="text" class="form-control @error('namaLibrarian') is-invalid @enderror" id="namaLibrarian" name="namaLibrarian" placeholder="Isikan disini...">
                                @error('namaLibrarian')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="emailLibrarian">Email Lengkap</small>
                                <input type="email" class="form-control @error('emailLibrarian') is-invalid @enderror" id="emailLibrarian" name="emailLibrarian" placeholder="Isikan disini...">
                                @error('emailLibrarian')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="nomorTelepon">Nomor Telepon</small>
                                <input type="text" class="form-control @error('nomorTelepon') is-invalid @enderror" id="nomorTelepon" name="nomorTelepon" placeholder="Isikan disini...">
                                @error('nomorTelepon')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="roleLibrarian">Role</small>
                                <select class="form-control" id="roleLibrarian" name="roleLibrarian">
                                  <option>Pustakawan</option>
                                  <option>Admin</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="alamatLibrarian">Alamat</small>
                                <textarea class="form-control @error('alamatLibrarian') is-invalid @enderror" id="alamatLibrarian" name="alamatLibrarian" placeholder="Isikan disini..." rows="3"></textarea>
                                @error('alamatLibrarian')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <small for="photoLibrarian">Photo</small>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="photoLibrarian" name="photoLibrarian"  onchange="document.getElementById('member-foto').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                  <label class="custom-file-label" for="photoLibrarian" id="name-label">Choose file</label>
                                </div>
                            </div>
                            @error('photoLibrarian')
                              <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                            @enderror
                          </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                          <div class="col-4 px-0">
                            <div class="preview-img" id="preview-img">
                                <img class="full-width full-height fit-cover" id="member-foto">
                            </div>
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

    <!-- Reset Kode Modal -->
    <div class="modal modal-admin fade" id="resetKode" tabindex="-1" aria-labelledby="addDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <h5>TAMBAH DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="form-reset"></div>
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
                    <div class="form-hapus d-inline-block"></div>
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
                                    <h1 class="detail-nama">Nama Lengkap</h1>
                                    <span class="badge badge-secondary detail-role mb-2">Admin</span>
                                    <p class="detail detail-username mb-2">Username : Ilhmshdq</p>
                                    <p class="detail detail-alamat">
                                        Alamat : Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam aspernatur est nisi dolorum vero!.
                                    </p>
                                    <p class="detail detail-phone">Phone : 082130486258</p>
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
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let modal = $(this)

            modal.find('.form-hapus').html(`
                                            <form action="{{url('/librarian/${id}')}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                            </form>`)
                                      });
        $('#resetKode').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let modal = $(this)

            modal.find('.form-reset').html(`
                                <form action="{{url('/librarian/reset-code/${id}')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                        <div class="row form-mg">
                                            <div class="col-12">
                                                <div class="text-center pt-1">
                                                    <button type="submit" class="btn btn-sm btn-success mt-2 px-5" name="tambahData">Ubah Kode Untuk Pengguna Ini</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </form>`)
        });
        $('#detailDataModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let name = button.data('name')
            let role = button.data('role')
            let username = button.data('username')
            let address = button.data('address')
            let phone = button.data('phone')
            let image = button.data('image')
            let modal = $(this)

            modal.find('.detail-nama').html(name)
            modal.find('.detail-role').html(role)
            modal.find('.detail-username').html(`Username : ${username}`)
            modal.find('.detail-alamat').html(`Alamat : ${address}`)
            modal.find('.detail-phone').html(`Phone : ${phone}`)
            modal.find('.image-buku').html(`<img src="${image}" alt="Foto" class="lib-foto full-width full-height fit-cover">`)
        });
    </script>
@endsection