@extends('../templates/admin')

@section('more-meta')
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="_base_url" content="{{ url('/') }}">
@endsection

@section('title', 'Data Transaksi')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/transaction') }}">Transaction</a></li>
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
                    <form action="{{url('/transaction/search')}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="col-4">
                            <div class="form-group">
                                <select class="form-control" name="by">
                                    <option value="nomor_induk">NIS/NIP</option>
                                    <option value="name">Nama</option>
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
                    <a href="{{ url('/transaction') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <button type="button" class="btn btn-success full-width" data-toggle="modal" data-target="#addDataModal"><i class="fas fa-plus"></i> Tambah Data</button>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Data Transaksi</h1>
                @foreach ($datas as $data)
                    <div class="transaction-item-wrapper position-relative shadow mb-3">
                        <div class="transaction-item position-absolute full-width py-2">
                            <div class="container-fluid full-height position-relative">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="id-transaksi py-2">Id Transaksi : {{$data->id}}</h1>
                                        <p class="person">{{$data->nomor_induk}} / {{$data->name}}</p>
                                        <div class="info">
                                            <p class="info-transaksi d-inline-block">Jumlah buku yang masih dipinjam : <span class="badge badge-secondary mt-2">{{$data->sum}} buku</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper position-absolute bottom-absolute full-width pl-3">
                                    <div class="container position-relative">
                                        <a href="{{url('/transaction/return-book/'.$data->id)}}" class="btn btn-sm btn-purple position-absolute bottom-absolute text-right rounded-0" title="Pengembalian"><i class="fas fa-exchange-alt"></i></a>
                                        <button type="button" class="btn btn-sm btn-info position-absolute bottom-absolute text-right rounded-0 text-white" title="Info" data-toggle="modal" data-target="#detailDataModal" data-id="{{$data->id}}" data-nomor="{{$data->nomor_induk}}"><i class="fas fa-info-circle"></i></button>
                                        <button type="button" class="btn btn-sm btn-success position-absolute bottom-absolute rounded-0" title="Edit" data-toggle="modal" data-target="#editDataModal" data-id="{{$data->id}}"><i class="fas fa-edit"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="pagination-btn position-relative mb-3 mr-2">
                    {{ $datas->links() }}
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-danger text-white btn-late position-fixed text-center" data-toggle="modal" data-target="#keterlambatanModal" data-today="{{$today}}">
        <div class="icon text-center d-inline-block"><i class="fas fa-stopwatch"></i></div>
        <span class="mb-5 d-inline-block ml-1">Keterlambatan</span>
    </button>

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
                <div class="modal-body py-1">
                    <div class="p-2">
                        <form action="{{url('/transaction/add/member')}}" method="POST" class="row">
                            @csrf
                            <div class="col-10 mb-2 pr-1">
                                <label for="nomorIndukMember" class="form-label">Nomor Induk Anggota</label>
                                <input type="number" class="form-control" id="nomorIndukMember" name="nomorIndukMember" placeholder="Isikan Disini">
                            </div>
                            <div class="col-2 pt-2 pl-2">
                                <button type="button" class="btn btn-primary full-width mt-4" id="cekAnggota"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="namaMember" class="form-label">Nama Anggota</label>
                                <input type="text" class="form-control" id="namaMember" placeholder="Nama akan muncul disini" readonly>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary full-width">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Data Modal -->
    <div class="modal modal-admin fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <h5>EDIT DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                  
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
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
                            <div class="col-12">
                                <div class="detail">
                                    <h1 class="detail-nama text-center"></h1>
                                    <p class="detail detail-username text-center mb-3"></p>
                                </div>
                            </div>
                        </div>
                        <div class="wrapper"></div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Keterlambatan Modal -->
    <div class="modal modal-admin fade" id="keterlambatanModal" tabindex="-1" aria-labelledby="detailDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55"><br>
                    <small style="color: gray">Berikut data anggota yang belum mengembalikan buku hingga batas waktu yang seharusnya</small>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="container-fluid">
                        <div class="wrapper"></div>
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
    {{-- <script src="js/transaction-modal.js"></script> --}}
    <script src="js/transaction-ajax.js"></script>
    <script>
             
        const checkBuku = (urutanBuku) => {
            let id = document.querySelector(`#idBuku${urutanBuku}`).value;
            id = id.replace('e','');
            console.log(id)
            document.querySelector(`#judulBuku${urutanBuku}`).value = "Mohon Tunggu";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: `/check-book`,
                method: 'post',
                data: {
                    id: jQuery(`#idBuku${urutanBuku}`).val()
                },
                success: function(result){
                    document.querySelector(`#judulBuku${urutanBuku}`).value = "Mohon Tunggu";
                    if (result !== "Not Found") document.querySelector(`#judulBuku${urutanBuku}`).value = result;
                    else document.querySelector(`#judulBuku${urutanBuku}`).value = "Mohon Tunggu";
                    
                }
            });
        }
        
    </script>
@endsection