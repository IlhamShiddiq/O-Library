@extends('../templates/base')

@section('title', 'Edit Profile')

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
                            <div class="breadcrumb-title position-absolute top-absolute text-center text-white">PROFILE</div>
                            <li class="breadcrumb-item active" aria-current="page">Member</li>
                            <li class="breadcrumb-item"><a href="{{asset('/member/edit-profile')}}">Edit Profile</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-lg-9 col-md-10 col-12">
                    <div class="form-edit-profile">
                        <div class="gray-wrapper radius-admin full-width px-5 mb-3 position-relative py-5">
                            <div class="header text-center py-3 px-3 position-absolute top-absolute bg-dark full-width text-white radius-admin">
                              <img src="{{asset('img/icon.png')}}" width="55" class="rounded-circle p-2" style="background-color: rgb(248, 248, 248)">
                            </div>
                            <div class="title py-3 text-center mb-1 mt-5">
                                <h1 class="title-admin">Edit Profile</h1>
                            </div>
                            <form action="{{url('/member/edit-profile')}}" method="post" enctype="multipart/form-data" class="mb-4">
                                @csrf
                                <div class="row">
                                  <div class="col-7 pr-1">
                                    <div class="form-group">
                                        <small for="namaMember">Nama Lengkap</small>
                                        <input type="text" class="form-control @error('namaMember') is-invalid @enderror" id="namaMember" name="namaMember" placeholder="Isikan disini..." value="">
                                        @error('namaMember')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-5 pl-1">
                                    <div class="form-group">
                                        <small for="usernameMember">Username</small>
                                        <input type="text" class="form-control @error('usernameMember') is-invalid @enderror" id="usernameMember" name="usernameMember" placeholder="Isikan disini..." readonly value="">
                                        @error('usernameMember')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="row form-mg">
                                  <div class="col-7 pr-1">
                                    <div class="form-group">
                                        <small for="nomorTelepon">Nomor Telepon</small>
                                        <input type="text" class="form-control  @error('nomorTelepon') is-invalid @enderror" id="nomorTelepon" name="nomorTelepon" placeholder="Isikan disini..." value="">
                                        @error('nomorTelepon')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-5 pl-1">
                                    <div class="form-group">
                                        <small for="statusMember">Status</small>
                                        <select class="form-control" id="statusMember" name="statusMember" disabled>
                                          <option value="Guru">Guru</option>
                                          <option value="Siswa">Siswa</option>
                                        </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row form-mg">
                                  <div class="col-12">
                                    <div class="form-group">
                                        <small for="emailMember">Email</small>
                                        <input type="email" class="form-control @error('emailMember') is-invalid @enderror" id="emailMember" name="emailMember" placeholder="Isikan disini..." value="">
                                        @error('emailMember')
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
                                        <small for="alamatMember">Alamat</small>
                                        <textarea class="form-control @error('alamatMember') is-invalid @enderror" id="alamatMember" name="alamatMember" placeholder="Isikan disini..." rows="3"></textarea>
                                        @error('alamatMember')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="row form-mg">
                                  <div class="col-12">
                                    <small for="photoMember">Photo</small>
                                    <div class="input-group">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input @error('photoMember') is-invalid @enderror" id="photoMember" name="photoMember" onchange="document.getElementById('member-foto').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                          <label class="custom-file-label" for="photoMember" id="name-label"></label>
                                        </div>
                                    </div>
                                    @error('photoMember')
                                      <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div class="row justify-content-center mt-3">
                                  <div class="col-4 px-0">
                                    <div class="preview-img" id="preview-img">
                                      <img src="" alt="" class="full-width full-height fit-cover" id="member-foto">
                                    </div>
                                  </div>
                                  <div class="col-8 text-black pt-3 px-1">
                                    <small>Mohon diisi secara lengkap,<br>serta diisi dengan data yang sebenar-benarnya.</small> <br>
                                    <button type="submit" class="btn btn-sm btn-success mt-3 px-5">Edit Data</button>
                                  </div>
                                </div>
                            </form>
                            <div class="footer position-absolute bottom-absolute bg-dark full-width radius-admin p-4"></div>
                        </div>
                    </div>
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