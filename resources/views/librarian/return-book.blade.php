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
            <div class="col-12 col-md-10 col-lg-8">
                <div class="gray-wrapper radius-admin full-width px-5 mb-3 position-relative py-5">
                    <div class="header text-center py-3 px-3 position-absolute top-absolute bg-dark full-width text-white radius-admin">
                      <img src="{{asset('img/icon.png')}}" width="55" class="rounded-circle p-2" style="background-color: rgb(248, 248, 248)">
                    </div>
                    <div class="title py-3 text-center mb-1 mt-5">
                        <h1 class="title-admin">Pengembalian Buku</h1>
                    </div>
                    <form class="mb-4" action="{{url('/transaction/return-book/'.$id_transaction)}}" method="POST">
                        @csrf
                        <div class="row">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="atasNama">Atas Nama</small>
                                <input type="text" class="form-control" id="atasNama" name="atasNama" placeholder="Isikan disini..." value="{{$data->name}}" readonly>
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="atasNamaNomorInduk">NIS/NIP</small>
                                <input type="text" class="form-control" id="atasNamaNomorInduk" name="atasNamaNomorInduk" placeholder="Isikan disini..." value="{{$data->nomor_induk}}" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 text-center mb-2">
                            <small>Buku yang dipinjam</small>
                          </div>
                        </div>
                        <div class="row justify-content-center">
                          <div class="col-12 col-md-11 col-lg-10">
                            <div class="input-group mb-3">
                              <div class="input-group-prepend" style="background-color: rgba(255, 255, 255, 0)">
                                <div class="input-group-text border-0" style="background-color: rgb(105, 105, 105)">
                                  <input type="checkbox" aria-label="Checkbox for following text input" name="returnBuku">
                                </div>
                              </div>
                              <input type="text" class="form-control border border-top-0 border-left-0 border-right-0 border-dark" aria-label="Text input with checkbox" id="judulBuku" name="judulBuku" style="background-color: rgba(255, 255, 255, 0)" value="{{$book_title[0]->title}}">
                              <input type="hidden" name="idBuku" value="{{$book_title[0]->id}}">
                            </div>
                          </div>
                        </div>
                        @if ($count_book == 2)
                          <div class="row justify-content-center">
                            <div class="col-12 col-md-11 col-lg-10">
                              <div class="input-group mb-3">
                                <div class="input-group-prepend" style="background-color: rgba(255, 255, 255, 0)">
                                  <div class="input-group-text border-0" style="background-color: rgb(105, 105, 105)">
                                    <input type="checkbox" aria-label="Checkbox for following text input" name="returnBukuKedua">
                                  </div>
                                </div>
                                <input type="text" class="form-control border border-top-0 border-left-0 border-right-0 border-dark" aria-label="Text input with checkbox" id="judulBukuKedua" name="judulBukuKedua" style="background-color: rgba(255, 255, 255, 0)" value="{{$book_title[1]->title}}">
                                <input type="hidden" name="idBukuKedua" value="{{$book_title[1]->id}}">
                              </div>
                            </div>
                          </div>
                        @endif
                        <div class="row justify-content-center">
                          <div class="col-12 text-center">
                            <button type="submit" class="btn btn-sm btn-success px-5 mt-3" name="tambahData">Submit</button>
                          </div>
                        </div>
                    </form>
                    <div class="footer position-absolute bottom-absolute bg-dark full-width radius-admin p-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection