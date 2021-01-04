@extends('../templates/admin')

@section('title', 'Data Member')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/member') }}">Member</a></li>
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
                    <form action="{{url('/member/search')}}" method="post">
                        @csrf
                        <div class="form-row">
                          <div class="col-4">
                            <div class="form-group">
                                <select class="form-control" name="by">
                                    <option value="name">Nama</option>
                                    <option value="status">Role</option>
                                    <option value="address">Alamat</option>
                                    <option value="class">Kelas</option>
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
                    <a href="{{ url('/member') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <button type="button" class="btn btn-success full-width" data-toggle="modal" data-target="#addDataModal"><i class="fas fa-plus"></i> Tambah Data</button>
                </div>
                <div class="total-row text-center p-3 border-bottom mb-5">
                  {{$count}} Data Ditampilkan
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Data Anggota</h1>
                <div class="list-wrapper">
                  @foreach ($members as $member)
                    <?php
                      $red = '';

                      if($member->status == 'Siswa') $icon = 'student.png';
                      else $icon = 'teacher.png';

                      if(!($member->username)) {
                        $red = 'color: red; font-style: italic;';
                        $member->username = 'Not confirmed yet';
                      } 
                    ?>
                    <div class="item-person p-2 position-relative mb-5 shadow">
                        <div class="photo-person-wrapper position-absolute bg-white p-1">
                            <div class="photo-person full-width">
                              <img src="{{asset('uploaded_files/member-foto/'.$member->profile_photo_path)}}" alt="{{$member->name}}" class="full-width full-height fit-cover">
                            </div>
                        </div>
                        <div class="role-person position-absolute">
                          <img src="{{asset('img/icons/'.$icon)}}" width="25">
                        </div>
                        <div class="data-person">
                            <h1 class="name-person py-2 mt-2">
                                {{$member->name}}
                            </h1>
                            <p class="contact-person">{{$member->phone}} / {{$member->email}}</p>
                            <p class="contact-person" style="margin-top: -15px; margin-bottom: 10px; {{$red}}">Username : {{$member->username}}</p>
                            <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$member->id}}">Hapus</a>
                            @if ($member->confirm_code != '')
                              <a href="#" class="badge badge-success" data-toggle="modal" data-target="#resetKode" data-id="{{$member->id}}">Reset Kode</a>
                            @endif
                            <a href="{{ url('/member/history/'.$member->id) }}" class="badge badge-info">Riwayat</a>
                        </div>
                        <div class="detail-wrapper position-absolute bottom-absolute shadow">
                          <button class="btn btn-dark" data-toggle="modal" data-target="#detailDataModal" data-name="{{$member->name}}" data-status="{{$member->status}}" data-username="{{$member->username}}" data-kelas="{{$member->class}}" data-email="{{$member->email}}" data-address="{{$member->address}}" data-phone="{{$member->phone}}" data-image="{{asset('uploaded_files/member-foto/'.$member->profile_photo_path)}}">Detail</button>
                        </div>
                    </div>
                  @endforeach
                </div>
                <div class="pagination-btn position-relative mr-2">
                  {{ $members->links() }}
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
                    <form action="{{url('/member')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="nomorInduk">NIS/NIP</small>
                                <input type="number" class="form-control @error('nomorInduk') is-invalid @enderror" id="nomorInduk" name="nomorInduk" placeholder="Isikan disini...">
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
                                <small for="namaLengkap">Nama Lengkap</small>
                                <input type="text" class="form-control @error('namaLengkap') is-invalid @enderror" id="namaLengkap" name="namaLengkap" placeholder="Isikan disini...">
                                @error('namaLengkap')
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
                                <small for="telpAnggota">Nomor Telepon</small>
                                <input type="number" class="form-control @error('telpAnggota') is-invalid @enderror" id="telpAnggota" name="telpAnggota" placeholder="Isikan disini...">
                                @error('telpAnggota')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="emailAnggota">Email</small>
                                <input type="email" class="form-control @error('emailAnggota') is-invalid @enderror" id="emailAnggota" name="emailAnggota" placeholder="Isikan disini...">
                                @error('emailAnggota')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row  mb-2">
                          <div class="col-6 text-right pr-1">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="roleAnggota" id="radioGuru" value="Guru" checked>
                              <label class="form-check-label" for="radioGuru">Guru</label>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="roleAnggota" id="radioSiswa" value="Siswa">
                              <label class="form-check-label" for="radioSiswa">Siswa</label>
                            </div>
                          </div>
                        </div>
                        <div class="row d-none" id="row-kelas">
                          <div class="col-4 pr-1 d-inline-block">
                            <div class="form-group">
                              <label for="tingkatAnggota">Tingkat</label>
                              <select class="form-control" id="tingkatAnggota" name="tingkatAnggota">
                                <option>X</option>
                                <option>XI</option>
                                <option>XII</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-4 px-1 d-inline-block">
                            <div class="form-group">
                              <label for="jurusanAnggota">Jurusan</label>
                              <select class="form-control" id="jurusanAnggota" name="jurusanAnggota">
                                <option>RPL</option>
                                <option>SIJA</option>
                                <option>IOP</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-4 pl-1 d-inline-block">
                            <div class="form-group">
                              <label for="kelasAnggota">Kelas</label>
                              <select class="form-control" id="kelasAnggota" name="kelasAnggota">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="alamatAnggota">Alamat</small>
                                <textarea class="form-control @error('alamatAnggota') is-invalid @enderror" id="alamatAnggota" name="alamatAnggota" placeholder="Isikan disini..." rows="3"></textarea>
                                @error('alamatAnggota')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <small for="photoAnggota">Photo</small>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="photoAnggota" name="photoAnggota" onchange="document.getElementById('member-foto').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                  <label class="custom-file-label" for="photoAnggota" id="name-label">Choose file</label>
                                </div>
                            </div>
                            @error('photoAnggota')
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
                                    <p class="detail detail-username">Username : Ilhmshdq</p>
                                    <p class="detail detail-class">Kelas : XII RPL A</p>
                                    <p class="detail detail-email mb-2">Email : shdqillham123@gmail.com</p>
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
    <script src="{{asset('js/member-modal.js')}}"></script>
    <script>
      $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let id = button.data('id')
        let modal = $(this)

        modal.find('.form-hapus').html(`
                                        <form action="{{url('/member/${id}')}}" method="POST">
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
                              <form action="{{url('/member/reset-code/${id}')}}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="row form-mg">
                                        <div class="col-12">
                                          <div class="text-center pt-1">
                                            <button type="submit" class="btn btn-sm btn-success mt-2 px-5" name="tambahData">Ubah Kode Untuk User Ini</button>
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
        let status = button.data('status')
        let username = button.data('username')
        let kelas = button.data('kelas')
        let email = button.data('email')
        let address = button.data('address')
        let phone = button.data('phone')
        let image = button.data('image')
        let modal = $(this)

        modal.find('.detail-nama').html(name)
        modal.find('.detail-role').html(status)
        modal.find('.detail-username').html(`Username : ${username}`)
        modal.find('.detail-class').html(`Kelas : ${kelas}`)
        modal.find('.detail-email').html(`Email : ${email}`)
        modal.find('.detail-alamat').html(`Alamat : ${address}`)
        modal.find('.detail-phone').html(`Phone : ${phone}`)
        modal.find('.image-buku').html(`<img src="${image}" alt="Foto" class="lib-foto full-width full-height fit-cover">`)
        });
    </script>
@endsection