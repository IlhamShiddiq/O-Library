@extends('../templates/member')

@section('title', 'Change Password')

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
@endsection