@extends('templates/admin')

@section('title', 'Tambah Transaksi')

@section('more-meta')
    <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/transaction') }}">Transaction</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/transaction/add') }}">Add</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4 p-0">
                <div class="gray-wrapper radius-admin">
                    <div class="info-login-pic text-center border-bottom pb-2">
                        <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="70" height="70">
                    </div>
                    <div class="info-login text-center pt-1">
                        <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                        <span class="badge badge-success">{{auth()->user()->role}}</span>
                    </div>
                </div>
                <div class="px-4 py-3 rounded border mt-3 mb-3">
                    <div class="mb-2 border-bottom">
                        <h5>DATA ANGGOTA</h5>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12 mb-2">
                                <label class="form-label">Nama Anggota</label>
                                <input type="text" class="form-control" placeholder="Nama akan muncul disini" readonly value="{{$member['name']}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <form action="{{url('/transaction/add/cancel')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger full-width">Batalkan Penambahan Peminjaman</button>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div class="px-4 py-3 rounded border">
                    <div class="mb-2 border-bottom">
                        <h5>PENDATAAN BUKU</h5>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <form action="{{ url('/transaction/add/book') }}" method="POST" class="row">
                                @csrf
                                <div class="col-10 mb-2 pr-1">
                                    <label for="isbn" class="form-label">Kode ISBN Buku</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN Kode" autofocus autocomplete="off">
                                </div>
                                <div class="col-2 mb-2 pt-2 pl-2">
                                    <button type="button" class="btn btn-primary full-width mt-4" onclick="cekBuku()"><i class="fas fa-search"></i></button>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="judul" placeholder="Judul akan muncul disini" readonly>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Penulis Buku</label>
                                    <input type="text" class="form-control" id="penulis" placeholder="Penulis akan muncul disini" readonly>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Penerbit Buku</label>
                                    <input type="text" class="form-control" id="penerbit" placeholder="Penerbit akan muncul disini" readonly>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success full-width mt-3">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-4">
                            <form class="row">
                                <div class="col-12 mb-2">
                                    <label class="form-label">Batas Peminjaman</label>
                                    <input type="text" class="form-control" value="2 Buku" readonly>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label">Peminjaman Sekarang</label>
                                    <input type="text" class="form-control" value="@if ($lists[0]['title'] == '-') 0 @else {{count($lists)}} @endif Buku" readonly>
                                </div>
                                <div class="col-12">
                                    <a href="{{url('/transaction/add/reset')}}" class="btn btn-sm btn-info text-center text-white full-width mt-2">Reset Buku</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 mt-3 rounded border">
                    <table class="table table-hover mb-3">
                        <thead class="table-dark">
                            <th class="text-center" width="175">Gambar Buku</th>
                            <th class="text-center">Judul</th>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <th>
                                        @if ($list['picture'] != '-')
                                            <img src="{{ asset('uploaded_files/book-cover/'.$list['picture']) }}" alt="{{$list['title']}}" class="full-width">
                                        @else 
                                            -
                                        @endif
                                    </th>
                                    <th>{{ $list['title'] }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form action="{{url('/transaction/add')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary full-width">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script>
        const cekBuku = () => {

            jQuery('#judul').val("");
            jQuery('#penulis').val("");
            jQuery('#penerbit').val("");
            jQuery('#judul').attr("placeholder", "Mohon Tunggu");
            jQuery('#penulis').attr("placeholder", "Mohon Tunggu");
            jQuery('#penerbit').attr("placeholder", "Mohon Tunggu");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: `/transaction-check-book`,
                method: 'post',
                data: {
                    isbn: jQuery('#isbn').val()
                },
                success: function(result){
                    const pieces = result.split("~");
                    jQuery('#judul').val(pieces[0]);
                    jQuery('#penulis').val(pieces[1]);
                    jQuery('#penerbit').val(pieces[2]);
                }
            });
        }
    </script>
@endsection