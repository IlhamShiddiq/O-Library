@extends('../templates/admin')

@section('title', 'Pengembalian Buku')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/transaction') }}">Transaction</a></li>
        <li class="breadcrumb-item active">Return Book</li>
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
                        <h1 class="title-admin">Pengembalian Buku</h1>
                    </div>
                    <form class="mb-4" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="atasNama">Atas Nama</small>
                                <input type="text" class="form-control" id="atasNama" name="atasNama" placeholder="Isikan disini..." readonly value="{{$name}}">
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="atasNamaNomorInduk">NIS/NIP</small>
                                <input type="text" class="form-control" id="atasNamaNomorInduk" name="atasNamaNomorInduk" placeholder="Isikan disini..." readonly value="{{$nomor_induk}}">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 text-center mb-2">
                            <small>Denda yang diperoleh</small>
                          </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="denda-line mb-1 full-width"></div>
                          <div class="denda-wrapper rounded p-4 text-white text-center">
                              <h1>RP {{$penalty}},-</h1>
                          </div>
                          <div class="denda-line mt-1 full-width"></div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-12 text-center">
                            <a href="{{url('/transaction')}}" class="btn btn-sm btn-primary px-5 mt-3" name="tambahData">Back</a>
                          </div>
                        </div>
                    </form>
                    <div class="footer position-absolute bottom-absolute bg-dark full-width radius-admin p-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection