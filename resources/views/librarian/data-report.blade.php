@extends('../templates/admin')

@section('title', 'Laporan')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/report') }}">Report</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4 p-0">
                <div class="line-report mt-5 mb-1"></div>
                <div class="text-center text-white p-2 mb-3 month-report-info">
                    Data Laporan Bulan {{date('F')}}
                </div>
                <div class="gray-wrapper radius-admin">
                    <div class="info-login-pic text-center border-bottom pb-2">
                        <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Foto" class="rounded-circle fit-cover" width="70" height="70">
                    </div>
                    <div class="info-login text-center pt-1">
                        <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                        <span class="badge badge-success">{{auth()->user()->role}}</span>
                    </div>
                </div>
                <div class="gray-wrapper radius-admin">
                    <form action="{{url('/report/search')}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="col-4">
                            <div class="form-group">
                                <select class="form-control" name="by">
                                    <option value="nomor_induk">NIS/NIP</option>
                                    <option value="borrow_date">Tanggal Pinjam</option>
                                    <option value="date_of_return">Tanggal Kembali</option>
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
                    <a href="{{ url('/report') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <div class="row">
                        <div class="col-8 pr-1">
                            <a href="{{ url('/report/late') }}" class="btn btn-danger full-width"><i class="fas fa-clock"></i> Data Keterlambatan</a>
                        </div>
                        <div class="col-2 pr-1">
                            <button href="button" class="btn btn-success full-width" data-toggle="modal" data-target="#excelsModal"><i class="fas fa-file-excel"></i></button>
                        </div>
                        <div class="col-2 pl-1">
                            <a href="{{ url('/pdf-report') }}" class="btn btn-primary full-width"><i class="fas fa-print"></i></a>
                        </div>
                    </div>
                </div>
                <div class="total-row text-center p-3 border-bottom mb-5">
                    {{$count}} Data Ditampilkan
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Laporan</h1>
                <div class="list-wrapper mb-3">
                    @foreach ($reports as $report)
                        <div class="transaction-item-wrapper position-relative shadow mb-3">
                            <div class="transaction-item position-absolute full-width py-2">
                                <div class="container-fluid full-height position-relative">
                                    <div class="row">
                                        <div class="col-12">
                                            <h1 class="id-transaksi py-2">id transaksi : {{$report->transaction_id}}</h1>
                                            <p class="person"><span class="badge badge-info text-white">{{$report->nomor_induk}} / {{$report->name}}</span></p>
                                            <div class="info">
                                                <div class="info-book">
                                                    <p class="info-transaksi">"{{$report->title}}"</p>
                                                </div>
                                                <div class="info-date">
                                                    <p class="info-transaksi d-inline-block">Tanggal pinjam : <span class="badge badge-secondary mt-2">{{$report->borrow_date}}</span> , </p>
                                                    <p class="info-transaksi d-inline-block">Tanggal kembali : <span class="badge badge-success mt-2">{{$report->date_of_return}}</span></p>
                                                </div>
                                                <div class="info-late">
                                                    @if(date_diff(date_create($report->borrow_date), date_create($report->date_of_return))->format('%a') > $config[0]->loan_deadline)
                                                        <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-danger mt-2">Yes</span></p> ,
                                                        <p class="info-transaksi d-inline-block">denda : Rp {{(date_diff(date_create($report->borrow_date), date_create($report->date_of_return))->format('%a') - $config[0]->loan_deadline) * $config[0]->late_charge}}</p>
                                                    @else
                                                        <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-success mt-2">No</span></p> ,
                                                        <p class="info-transaksi d-inline-block">denda : Rp -</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-btn position-relative mb-3 mr-2">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Excels Modal -->
    <div class="modal modal-admin fade" id="excelsModal" tabindex="-1" aria-labelledby="addDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-5">
                    <div class="container-fluid">
                        <form action="{{url('/excel-report')}}" method="POST">
                            @csrf
                            <div class="text-center mb-3">Data apa saja yang ingin anda export menjadi file excel?</div>
                            <div class="form-check mb-2">
                                <div class="checkbox-wrapper checkbox-wrapper-unchecked text-white position-relative full-width p-2" id="wrapper-buku">
                                    <div class="line-checkbox py-1 position-absolute"></div>
                                    <input class="ml-2" name="queue[]" type="checkbox" value="Book" id="check-buku">
                                    <h6 class="d-inline-block m-0 ml-2">DATA BUKU</h6>
                                </div>
                            </div>
                            <div class="form-check mb-2">
                                <div class="checkbox-wrapper checkbox-wrapper-unchecked text-white position-relative full-width p-2" id="wrapper-ebook">
                                    <div class="line-checkbox py-1 position-absolute"></div>
                                    <input class="ml-2" name="queue[]" type="checkbox" value="Ebook" id="check-ebook">
                                    <h6 class="d-inline-block m-0 ml-2">DATA EBOOK</h6>
                                </div>
                            </div>
                            <div class="form-check mb-2">
                                <div class="checkbox-wrapper checkbox-wrapper-unchecked text-white position-relative full-width p-2" id="wrapper-member">
                                    <div class="line-checkbox py-1 position-absolute"></div>
                                    <input class="ml-2" name="queue[]" type="checkbox" value="Member" id="check-member">
                                    <h6 class="d-inline-block m-0 ml-2">DATA ANGGOTA</h6>
                                </div>
                            </div>
                            <div class="form-check mb-2">
                                <div class="checkbox-wrapper checkbox-wrapper-unchecked text-white position-relative full-width p-2" id="wrapper-librarian">
                                    <div class="line-checkbox py-1 position-absolute"></div>
                                    <input class="ml-2" name="queue[]" type="checkbox" value="Librarian" id="check-librarian">
                                    <h6 class="d-inline-block m-0 ml-2">DATA PUSTAKAWAN</h6>
                                </div>
                            </div>
                            <div class="form-check mb-2">
                                <div class="checkbox-wrapper checkbox-wrapper-unchecked text-white position-relative full-width p-2" id="wrapper-publisher">
                                    <div class="line-checkbox py-1 position-absolute"></div>
                                    <input class="ml-2" name="queue[]" type="checkbox" value="Publisher" id="check-publisher">
                                    <h6 class="d-inline-block m-0 ml-2">DATA PENERBIT</h6>
                                </div>
                            </div>
                            <div class="form-check mb-2">
                                <div class="checkbox-wrapper checkbox-wrapper-unchecked text-white position-relative full-width p-2" id="wrapper-category">
                                    <div class="line-checkbox py-1 position-absolute"></div>
                                    <input class="ml-2" name="queue[]" type="checkbox" value="Category" id="check-category">
                                    <h6 class="d-inline-block m-0 ml-2">DATA KATEGORI</h6>
                                </div>
                            </div>
                            <div class="form-check mb-2">
                                <div class="checkbox-wrapper checkbox-wrapper-unchecked text-white position-relative full-width p-2" id="wrapper-report">
                                    <div class="line-checkbox py-1 position-absolute"></div>
                                    <input class="ml-2" name="queue[]" type="checkbox" value="Report" id="check-report">
                                    <h6 class="d-inline-block m-0 ml-2">DATA SELURUH LAPORAN TRANSAKSI</h6>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-0 full-width ml-2">Submit</button>
                        </form>
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
    <script src="{{asset('js/checkbox-script.js')}}"></script>
@endsection