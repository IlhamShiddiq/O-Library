@extends('templates/admin')

@section('title', 'Kartu Anggota')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item active" aria-current="page">Card Member</li>
    </ol>
@endsection

@section('content')
    <div class="row justify-content-center pdf-report-wrapper mt-2 mb-5">
        <div class="col-lg-9 col-md-10 col-11">
            <div class="print-pdf d-inline-block">
                <a href="{{url('/member/card/'.$data->id)}}" id="print-card" class="btn btn-sm btn-success"><i class="fas fa-download"></i></a>
            </div>
            <div class="a d-none" id="load">
                <div class="ml-2 d-inline-block load rounded-circle"></div>
                <div class="d-inline-block">
                    <small>Mohon Tunggu, file sedang diproses</small>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-10 col-11 my-3">
            <div class="line-green full-width"></div>
        </div>
        <div class="col-lg-9 col-md-10 col-11">
            <div class="border py-4">
                <div class="cetak-kartu" style="background-color: white;">
                    <div class="member-card-wrapper py-2">
                        <div class="member-card shadow border depan">
                            <div class="header">
                                <img src="{{asset('img/bg-card.jpg')}}" alt="Perpustakaan">
                            </div>
                            <div class="profile">
                                <div class="foto">
                                    <img src="{{asset('uploaded_files/member-foto/'.$data->profile_photo_path)}}" alt="Foto" class="object-fit">
                                </div>
                                <div class="name-wrapper">
                                    <div class="name">
                                        <h1>{{$data->name}}</h1>
                                        <h2>Kartu Anggota</h2>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="footer">
                                Perpustakaan SMKN 1 Cimahi
                            </div> --}}
                        </div>
                        {{-- <div class="member-card shadow border belakang">
                            <div class="header">
                                <img src="{{asset('img/bg-card.jpg')}}" alt="">
                            </div>
                            <div class="profile">
                                <div class="rules-wrapper">
                                    <div class="rules"></div>
                                </div>
                            </div>
                            <div class="footer">
                                Perpustakaan SMKN 1 Cimahi
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script src="{{asset('js/print-pdf.js')}}"></script>
@endsection