@extends('../templates/admin')

@section('title', 'Change Password')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/change-password') }}">Change Password</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-4 p-0 mt-4">
                <div class="gray-wrapper radius-admin">
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
                          <div class="col-12 col-md-6 col-lg-6 pr-1">
                            <div class="form-group">
                                <small for="username">Username</small>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Isikan disini..." readonly value="{{$data['username']}}">
                            </div>
                          </div>
                          <div class="col-12 col-md-6 col-lg-6 pl-1">
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
                          <div class="col-12 col-md-6 col-lg-6 pr-1">
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
                          <div class="col-12 col-md-6 col-lg-6 pl-1">
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
@endsection