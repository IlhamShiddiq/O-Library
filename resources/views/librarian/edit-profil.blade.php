@extends('../templates/admin')

@section('title', 'Edit Profile')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/edit-profile') }}">Edit Profile</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 mt-5 mt--5">
                <div class="gray-wrapper radius-admin full-width px-5 mb-3 position-relative py-5">
                    <div class="header text-center py-3 px-3 position-absolute top-absolute bg-dark full-width text-white radius-admin">
                      <img src="{{asset('img/icon.png')}}" width="55" class="rounded-circle p-2" style="background-color: rgb(248, 248, 248)">
                    </div>
                    <div class="title py-3 text-center mb-1 mt-5">
                        <h1 class="title-admin">Edit Profile</h1>
                    </div>
                    <form action="{{url('/edit-profile')}}" method="post" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="row">
                          <div class="col-7 pr-1">
                            <div class="form-group">
                                <small for="namaLibrarian">Nama Lengkap</small>
                                <input type="text" class="form-control @error('namaLibrarian') is-invalid @enderror" id="namaLibrarian" name="namaLibrarian" placeholder="Isikan disini..." value="{{$data['name']}}">
                                @error('namaLibrarian')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-5 pl-1">
                            <div class="form-group">
                                <small for="usernameLibrarian">Username</small>
                                <input type="text" class="form-control @error('usernameLibrarian') is-invalid @enderror" id="usernameLibrarian" name="usernameLibrarian" placeholder="Isikan disini..." readonly value="{{$data['username']}}">
                                @error('usernameLibrarian')
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
                                <input type="text" class="form-control  @error('nomorTelepon') is-invalid @enderror" id="nomorTelepon" name="nomorTelepon" placeholder="Isikan disini..." value="{{$data['phone']}}">
                                @error('nomorTelepon')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-5 pl-1">
                            <div class="form-group">
                                <small for="roleLibrarian">Role</small>
                                <select class="form-control" id="roleLibrarian" name="roleLibrarian" disabled>
                                  <option value="Pustakawan" @if($data['role'] == 'Pustakawan') selected @endif>Pustakawan</option>
                                  <option value="Admin" @if($data['role'] == 'Admin') selected @endif>Admin</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="emailLibrarian">Email</small>
                                <input type="email" class="form-control @error('emailLibrarian') is-invalid @enderror" id="emailLibrarian" name="emailLibrarian" placeholder="Isikan disini..." value="{{$data['email']}}">
                                @error('emailLibrarian')
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
                                <small for="alamatLibrarian">Alamat</small>
                                <textarea class="form-control @error('alamatLibrarian') is-invalid @enderror" id="alamatLibrarian" name="alamatLibrarian" placeholder="Isikan disini..." rows="3">{{$data['address']}}</textarea>
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
                                  <input type="file" class="custom-file-input @error('photoLibrarian') is-invalid @enderror" id="photoLibrarian" name="photoLibrarian" onchange="document.getElementById('member-foto').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                  <label class="custom-file-label" for="photoLibrarian" id="name-label">{{$data['photo']}}</label>
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
                              <img src="{{asset('uploaded_files/librarian-foto/'.$data['photo'])}}" alt="{{$data['name']}}" class="full-width full-height fit-cover" id="member-foto">
                            </div>
                          </div>
                          <div class="col-8 text-black pt-3 px-1 petunjuk-edit">
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
@endsection