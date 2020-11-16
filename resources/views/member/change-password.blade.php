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
                        <div class="gray-wrapper radius-admin full-width px-5 mb-3 position-relative py-5 mt-4">
                            <div class="header text-center py-3 px-3 position-absolute top-absolute bg-dark full-width text-white radius-admin">
                              <img src="{{asset('img/icon.png')}}" width="55" class="rounded-circle p-2" style="background-color: rgb(248, 248, 248)">
                            </div>
                            <div class="title py-3 text-center mb-1 mt-5">
                                <h1 class="title-admin">Change Password</h1>
                            </div>
                            <form class="mb-4" action="{{url('/change-password')}}" method="post">
                                @csrf
                                <div class="row">
                                  <div class="col-6 pr-1">
                                    <div class="form-group">
                                        <small for="username">Username</small>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Isikan disini..." readonly value="">
                                    </div>
                                  </div>
                                  <div class="col-6 pl-1">
                                    <div class="form-group">
                                        <small for="oldPassword">Password Lama</small>
                                        <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword" name="oldPassword" placeholder="Isikan disini...">
                                        @error('oldPassword')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-6 pr-1">
                                    <div class="form-group">
                                        <small for="newPassword">Password Baru</small>
                                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword" placeholder="Isikan disini...">
                                        @error('newPassword')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="col-6 pl-1">
                                    <div class="form-group">
                                        <small for="confirmPassword">Konfirmasi Password Baru</small>
                                        <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword" name="confirmPassword" placeholder="Isikan disini...">
                                        @error('confirmPassword')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="row justify-content-center">
                                  <div class="col-12 text-center">
                                    <div class="form-group form-check">
                                      <input type="checkbox" class="form-check-input @error('checkboxConfirm') is-invalid @enderror" id="checkboxConfirm" name="checkboxConfirm">
                                      <label class="form-check-label" for="checkboxConfirm">Saya yakin ingin mengubah password</label>
                                      @error('checkboxConfirm')
                                          <div id="validationServer03Feedback" class="invalid-feedback">
                                            {{$message}}
                                          </div>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="row justify-content-center">
                                  <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-sm btn-success px-5" name="tambahData">Change Password</button>
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