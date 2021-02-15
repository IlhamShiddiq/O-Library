@extends('../templates/admin')

@section('title', 'Detail Member')


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/member') }}">Member</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
        <li class="breadcrumb-item active" aria-current="page">{{$data->id}}</li>
    </ol>
@endsection

@section('content')
    <div class="detail-for-member full-width">
        <div class="person-detail-for-member">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-4 p-2">
                        <div class="gray-wrapper radius-admin">
                            <div class="text-center border-bottom pb-2">
                                <div class="foto-detail rounded-circle my-4">
                                    <img src="{{asset('uploaded_files/member-foto/'.$data->profile_photo_path)}}" alt="{{$data->name}}" class="fit-cover full-width rounded-circle">
                                </div>
                            </div>
                            <div class="text-center pt-1">
                                <p class="m-1">{{$data->role}}</p>
                            </div>
                            <div>
                                <a href="{{url('/member/history/'.$data->id)}}" class="btn btn-sm btn-info text-white full-width">Riwayat Peminjaman</a>
                            </div>
                        </div>
                        <div class="green-line full-width mt-2 py-2 rounded-bottom"></div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 p-3">
                        <div class="name-member p-2 border-bottom"><h1>{{$data->name}} <span>- {{$data->nomor_induk}}</span></h1></div>
                        <div class="detail-buku-data p-2">
                            <div class="detail-buku-kategori mt-2 mb-3">
                                <span class="badge badge-success py-2 px-4">{{$data->status}}</span>
                                @if ($data->class)   
                                    <span class="badge badge-info py-2 px-3 text-white">{{$data->class}}</span>
                                @endif
                            </div>

                            @if ($data->username)  
                                <p class="username">Username : <span>{{$data->username}}</span></p>
                            @else
                                <p class="username">Username : <span style="color: red; font-style: italic;">Not confirmed yet</span></p>
                            @endif
                            <div class="gray-wrapper p-2">
                                <i class="fas fa-envelope-open"></i>&nbsp; {{$data->email}}
                            </div>
                            <div class="gray-wrapper p-2">
                                <i class="fas fa-phone"></i>&nbsp; {{$data->phone}}
                            </div>
                            <div class="gray-wrapper p-2">
                                <i class="fas fa-home"></i>&nbsp; {{$data->address}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection