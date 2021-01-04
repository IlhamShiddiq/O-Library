@extends('../templates/admin')

@section('more-meta')
    <meta name="_token" content="{{ csrf_token() }}">
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
                                        <button type="button" class="btn btn-sm btn-info position-absolute bottom-absolute text-right rounded-0" title="Info" data-toggle="modal" data-target="#detailDataModal" data-id="{{$data->id}}" data-nomor="{{$data->nomor_induk}}"><i class="fas fa-info-circle"></i></button>
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
                <div class="modal-body py-3">
                    <form action="{{url('/transaction')}}" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="nameLibrarian">Nama Pustakawan (Librarian in charge)</small>
                                <input type="text" class="form-control" id="nameLibrarian" name="nameLibrarian" placeholder="Isikan disini..." value="{{auth()->user()->name}}" readonly>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="nomorIndukLibrarian">NIP</small>
                                <input type="text" class="form-control" id="nomorIndukLibrarian" name="nomorIndukLibrarian" placeholder="Isikan disini..." value="{{auth()->user()->nomor_induk}}" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-6 pr-1">
                            <small for="nomorIndukMember">NIS/NIP Anggota</small>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control @error('nomorIndukMember') is-invalid @enderror" id="nomorIndukMember" name="nomorIndukMember" placeholder="Isikan disini...">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary btn-sm-text px-2" id="cekAnggota"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="namaMember">Nama Anggota</small>
                                <input type="text" class="form-control" id="namaMember" name="namaMember" placeholder="Isikan disini..." readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3 py-2 gray-bg gray-bg-transaction">
                            <div class="col-12 text-center">
                                <small>Jumlah buku dipinjam</small>
                            </div>
                            <div class="col-6 text-right pr-1">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jumlahPinjam" id="satuBuku" value="1" checked>
                                <label class="form-check-label" for="satuBuku">1 Buku</label>
                              </div>
                            </div>
                            <div class="col-6 pl-1">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jumlahPinjam" id="duaBuku" value="2">
                                <label class="form-check-label" for="duaBuku">2 Buku</label>
                              </div>
                            </div>
                          </div>
                        <div class="row form-mg">
                            <div class="col-6 pr-1">
                                <div class="form-group">
                                    <small for="idBukuPertama">ID Buku</small>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control @error('idBukuPertama') is-invalid @enderror" id="idBukuPertama" name="idBukuPertama" placeholder="Isikan disini...">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm-text px-2" id="cekBukuPertama"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <small for="judulBukuPertama">Judul Buku</small>
                                    <input type="text" class="form-control" id="judulBukuPertama" name="judulBukuPertama" placeholder="Isikan disini..." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row form-mg d-none" id="row-buku-dua">
                            <div class="col-6 pr-1 d-inline-block">
                                <div class="form-group">
                                    <small for="idBukuKedua">ID Buku kedua</small>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" id="idBukuKedua" name="idBukuKedua" placeholder="Isikan disini...">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary mb-1 btn-sm-text px-2 full-height" id="cekBukuKedua"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pl-1 d-inline-block">
                                <div class="form-group">
                                    <small for="judulBukuKedua">Judul Buku kedua</small>
                                    <input type="text" class="form-control" id="judulBukuKedua" name="judulBukuKedua" placeholder="Isikan disini..." readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-12 text-center px-1">
                            <button type="submit" class="btn btn-primary mt-3 px-5" name="tambahData">Tambah Data</button>
                          </div>
                        </div>
                    </form>
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
    <script src="js/transaction-modal.js"></script>
    <script>
        $('#detailDataModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget)
            const id = button.data('id')
            const nomor = button.data('nomor')
            let wrapper = '';

            const modal = $(this)
            modal.find('.wrapper').html(`
                                        <div class="text-center">
                                            <div class='load d-inline-block rounded-circle mr-1'></div>
                                            <div class='load d-inline-block rounded-circle'></div>
                                            <div class='load d-inline-block rounded-circle ml-1'></div>
                                        </div>`)
            modal.find('.detail-nama').html(`ID TRANSAKSI : ${id}`)
            modal.find('.detail-username').html(`NIS/NIP : ${nomor}`)
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/check-detail') }}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(result){
                    let splits = result.split('~');
                    splits.forEach((split) => {
                        if(split == '') return;

                        wrapper += `
                                    <div class="row form-mg">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <small for="judulBukuPertamaDetail">Buku yang dipinjam</small>
                                                <input type="text" class="form-control" name="judulBukuPertamaDetail" value="${split}" readonly>
                                            </div>
                                        </div>
                                    </div>`;
                    })
                    modal.find('.wrapper').html(wrapper)
                }
            });
        })

        $('#editDataModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget)
            const id = button.data('id')
            let wrapper = '';

            const modal = $(this)
            modal.find('.modal-body').html(`
                                        <form action="{{url('transaction/edit/${id}')}}" method="POST">
                                            @csrf
                                            <div class="wrapper"></div>
                                        </form>`)

            modal.find('.wrapper').html(`
                                        <div class="text-center">
                                            <div class='load d-inline-block rounded-circle mr-1'></div>
                                            <div class='load d-inline-block rounded-circle'></div>
                                            <div class='load d-inline-block rounded-circle ml-1'></div>
                                        </div>`)
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/check-detail-edit') }}",
                method: 'post',
                data: {
                    id: id
                },
                success: function(result){
                    let splits = result.split('~');
                    console.log(splits)
                    const count = splits[0];
                    
                    wrapper += `
                            <div class="row form-mg">
                                <div class="col-5 pr-1">
                                    <div class="form-group">
                                        <small for="idBukuPertamaEdit">ID Buku</small>
                                        <input type="text" class="form-control" id="idBukuPertamaEdit" name="idBukuPertamaEdit" placeholder="Isikan disini..." value="${splits[1]}">
                                    </div>
                                </div>
                                <div class="col-1 pl-1">
                                    <button type="button" class="btn btn-primary mt-4 btn-sm-text px-2" id="cekBukuPertamaEdit"><i class="fas fa-search"></i></button>
                                </div>
                                <div class="col-6 pl-1">
                                    <div class="form-group">
                                        <small for="judulBukuPertamaEdit">Judul Buku</small>
                                        <input type="text" class="form-control" id="judulBukuPertamaEdit" name="judulBukuPertamaEdit" placeholder="Isikan disini..." readonly value="${splits[2]}">
                                    </div>
                                </div>
                            </div>`

                    if(count == '2')
                    {
                        wrapper += `
                            <div class="row form-mg" id="row-buku-dua-detail">
                                <div class="col-5 pr-1">
                                    <div class="form-group">
                                        <small for="idBukuKeduaEdit">ID Buku kedua</small>
                                        <input type="text" class="form-control" id="idBukuKeduaEdit" name="idBukuKeduaEdit" placeholder="Isikan disini..." value="${splits[3]}">
                                    </div>
                                </div>
                                <div class="col-1 pl-1">
                                    <button type="button" class="btn btn-primary mt-4 btn-sm-text px-2" id="cekBukuKeduaEdit"><i class="fas fa-search"></i></button>
                                </div>
                                <div class="col-6 pl-1">
                                    <div class="form-group">
                                        <small for="judulBukuKeduaEdit" >Judul Buku Kedua</small>
                                        <input type="text" class="form-control" id="judulBukuKeduaEdit" name="judulBukuKeduaEdit" placeholder="Isikan disini..." readonly value="${splits[4]}">
                                    </div>
                                </div>
                            </div>`
                    }

                    wrapper += `
                            <div class="row justify-content-center">
                                <div class="col-12 text-center px-1 btn-wrapper">
                                    <button type="submit" class="btn btn-sm btn-success px-4">Edit Data</button>
                                </div>
                            </div>`

                    modal.find('.wrapper').html(wrapper)

                    
                    jQuery('#cekBukuPertamaEdit').click(function(e){
                        jQuery('#judulBukuPertamaEdit').val("");
                        jQuery('#judulBukuPertamaEdit').attr("placeholder", "Mohon Tunggu...");
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        jQuery.ajax({
                            url: "{{ url('/check-book') }}",
                            method: 'post',
                            data: {
                                id: jQuery('#idBukuPertamaEdit').val()
                            },
                            success: function(result){
                                jQuery('#judulBukuPertamaEdit').val(result);
                            }
                        });
                    });
                    
                    jQuery('#cekBukuKeduaEdit').click(function(e){
                        jQuery('#judulBukuKeduaEdit').val("");
                        jQuery('#judulBukuKeduaEdit').attr("placeholder", "Mohon Tunggu...");
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        jQuery.ajax({
                            url: "{{ url('/check-book') }}",
                            method: 'post',
                            data: {
                                id: jQuery('#idBukuKeduaEdit').val()
                            },
                            success: function(result){
                                jQuery('#judulBukuKeduaEdit').val(result);
                            }
                        });
                    });
                }
            });
        })
    </script>
    <script>
        jQuery('#cekAnggota').click(function(e){
            jQuery('#namaMember').val("");
            jQuery('#namaMember').attr("placeholder", "Mohon Tunggu");
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/check-member') }}",
                method: 'post',
                data: {
                    nomor_induk: jQuery('#nomorIndukMember').val()
                },
                success: function(result){
                    jQuery('#namaMember').val(result);
                }
            });
        });

        jQuery('#cekBukuPertama').click(function(e){
            jQuery('#judulBukuPertama').val("");
            jQuery('#judulBukuPertama').attr("placeholder", "Mohon Tunggu...");
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/check-book') }}",
                method: 'post',
                data: {
                    id: jQuery('#idBukuPertama').val()
                },
                success: function(result){
                    jQuery('#judulBukuPertama').val(result);
                }
            });
        });

        jQuery('#cekBukuKedua').click(function(e){
            jQuery('#judulBukuKedua').val("");
            jQuery('#judulBukuKedua').attr("placeholder", "Mohon Tunggu...");
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/check-book') }}",
                method: 'post',
                data: {
                    id: jQuery('#idBukuKedua').val()
                },
                success: function(result){
                    jQuery('#judulBukuKedua').val(result);
                }
            });
        });
        $('#keterlambatanModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            const today = button.data('today')

            var modal = $(this)
            modal.find('.wrapper').html(`
                                        <div class="text-center">
                                            <div class='load d-inline-block rounded-circle mr-1'></div>
                                            <div class='load d-inline-block rounded-circle'></div>
                                            <div class='load d-inline-block rounded-circle ml-1'></div>
                                        </div>`)
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/late-transaction') }}",
                method: 'post',
                data: {},
                success: function(result){
                    datas = result.split('~')
                    datas.splice(datas.length - 1)

                    let array_datas = []
                    while(datas.length > 0) {

                        let new_array = datas.splice(0, 8)

                        array_datas.push(new_array)
                    }

                    let content = '';
                    array_datas.forEach((data) => {
                        if(data[7] > today) return

                        content += `
                                <div class="card late-card text-white bg-danger full-width mb-2 shadow">
                                    <div class="card-header user position-relative">
                                        ${data[4]} (${data[3]}/${data[5]})
                                        <a href="{{url('/send-reminder/${data[0]}')}}" class="btn btn-light btn-sm btn-email position-absolute"><i class="fas fa-envelope-open"></i></a>
                                    </div>
                                    <div class="card-body py-2">
                                        <p class="card-text m-0">${data[6]}</p>
                                        <small class="text-white">Tenggang waktu : ${data[1]} s/d ${data[7]}</small>
                                    </div>
                                </div>
                                `
                    })
                    modal.find('.wrapper').html(content)
                }
            });
        })
    </script>
@endsection