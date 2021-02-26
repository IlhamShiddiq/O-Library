@extends('../templates/member')

@section('title', 'Edit Profile')

@section('breadcrumb')
  <div class="col-12">
    <div class="breadcrumb-container">
        <ol class="breadcrumb position-relative">
            <div class="breadcrumb-title position-absolute top-absolute text-center text-white">PROFILE</div>
            <li class="breadcrumb-item active" aria-current="page">Member</li>
            <li class="breadcrumb-item"><a href="{{asset('/member/edit-profile')}}">Edit Profile</a></li>
        </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="col-lg-9 col-md-10 col-12">
    <div class="form-edit-profile form-edit-profile-member">
      <div class="gray-wrapper radius-admin full-width px-5 mb-3 position-relative border py-5">
          <div class="header text-center py-3 px-3 position-absolute top-absolute bg-dark full-width text-white radius-admin">
            <img src="{{asset('img/icon.png')}}" width="55" class="rounded-circle p-2" style="background-color: rgb(248, 248, 248)">
          </div>
          <div class="title py-3 text-center mb-1 mt-5">
              <h1 class="title-admin">Edit Profile</h1>
          </div>
          <form action="{{url('/member/edit-profile')}}" method="post" enctype="multipart/form-data" class="mb-4">
              @csrf
              <div class="row">
                <div class="col-12 col-lg-7 col-md-7 pr-1 name-edit-member">
                  <div class="form-group">
                      <small for="namaMember">Nama Lengkap</small>
                      <input type="text" class="form-control @error('namaMember') is-invalid @enderror" id="namaMember" name="namaMember" placeholder="Isikan disini..." value="{{$datas[0]->name}}">
                      @error('namaMember')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          {{$message}}
                        </div>
                      @enderror
                  </div>
                </div>
                <div class="col-12 col-lg-5 col-md-5 pl-1 username-edit-member">
                  <div class="form-group">
                      <small for="usernameMember">Username</small>
                      <input type="text" class="form-control @error('usernameMember') is-invalid @enderror" id="usernameMember" name="usernameMember" placeholder="Isikan disini..." readonly value="{{$datas[0]->username}}">
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
                      <input type="text" class="form-control  @error('nomorTelepon') is-invalid @enderror" id="nomorTelepon" name="nomorTelepon" placeholder="Isikan disini..." value="{{$datas[0]->phone}}">
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
                        <option @if ($datas[0]->status == 'Guru') selected @endif value="Guru">Guru</option>
                        <option @if ($datas[0]->status == 'Siswa') selected @endif value="Siswa">Siswa</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="row form-mg">
                <div class="col-12">
                  <div class="form-group">
                      <small for="emailMember">Email</small>
                      <input type="email" class="form-control @error('emailMember') is-invalid @enderror" id="emailMember" name="emailMember" placeholder="Isikan disini..." value="{{$datas[0]->email}}">
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
                      <textarea class="form-control @error('alamatMember') is-invalid @enderror" id="alamatMember" name="alamatMember" placeholder="Isikan disini..." rows="3">{{$datas[0]->address}}</textarea>
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
                        <label class="custom-file-label" for="photoMember" id="name-label">{{$datas[0]->profile_photo_path}}</label>
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
                    <img src="{{asset('uploaded_files/member-foto/'.$datas[0]->profile_photo_path)}}" alt="{{$datas[0]->name}}" class="full-width full-height fit-cover" id="member-foto">
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
@endsection