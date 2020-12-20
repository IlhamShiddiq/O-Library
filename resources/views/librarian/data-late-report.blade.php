@extends('../templates/admin')

@section('title', 'Laporan')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/report') }}">Report</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/report/late') }}">Late</a></li>
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
                        <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="70" height="70">
                    </div>
                    <div class="info-login text-center pt-1">
                        <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                        <span class="badge badge-success">{{auth()->user()->role}}</span>
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
                                            <p class="person"><span class="badge badge-info">{{$report->nomor_induk}} / {{$report->name}}</span></p>
                                            <div class="info">
                                                <div class="info-book">
                                                    <p class="info-transaksi">"{{$report->title}}"</p>
                                                </div>
                                                <div class="info-date">
                                                    <p class="info-transaksi d-inline-block">Tanggal pinjam : <span class="badge badge-secondary mt-2">{{$report->borrow_date}}</span> , </p>
                                                    <p class="info-transaksi d-inline-block">Tanggal kembali : <span class="badge badge-success mt-2">{{$report->date_of_return}}</span></p>
                                                </div>
                                                <div class="info-late">
                                                    @if(date_diff(date_create($report->borrow_date), date_create($report->date_of_return))->format('%a') > 14)
                                                        <p class="info-transaksi d-inline-block">Terlambat : <span class="badge badge-danger mt-2">Yes</span></p> ,
                                                        <p class="info-transaksi d-inline-block">denda : Rp {{(date_diff(date_create($report->borrow_date), date_create($report->date_of_return))->format('%a') - 14) * 1000}}</p>
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
@endsection