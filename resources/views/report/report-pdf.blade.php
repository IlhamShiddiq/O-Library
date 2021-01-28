@extends('templates/admin')

@section('title', 'PDF Report')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/pdf-report') }}">Print Report</a></li>
    </ol>
@endsection

@section('content')
    <div class="row justify-content-center pdf-report-wrapper mt-2 mb-5">
        <div class="col-lg-9 col-md-10 col-11">
            <div class="print-pdf d-inline-block">
                <a href="{{url('/pdf-report-print')}}" id="print-pdf" class="btn btn-sm btn-success"><i class="fas fa-download"></i></a>
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
                <div class="pdf-report border">
                    <div class="header p-5 text-white">
                        <h1 class="title text-center">LAPORAN TRANSAKSI</h1>
                        <h2 class="sub-title text-center">Perpustakaan SMK Negeri 1 Kota Cimahi</h2>
                    </div>
                    <div class="info py-4 px-5">
                        <table>
                            <tr>
                                <td style="width: 140px;">Kode Laporan</td>
                                <td style="width: 30px;">=</td>
                                <td>{{date('n')}} / {{date('Y')}}</td>
                            </tr>
                            <tr>
                                <td style="width: 140px;">Laporan Bulan</td>
                                <td style="width: 30px;">=</td>
                                <td>{{date('F')}}</td>
                            </tr>
                            <tr>
                                <td style="width: 140px;">Dicetak Tanggal</td>
                                <td style="width: 30px;">=</td>
                                <td>{{date('d M Y')}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="konten px-4 py-4 my-2">
                        <table class="table table-bordered">
                            <thead class="text-white">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px">No</th>
                                <th scope="col" class="text-center">Kategori</th>
                                <th scope="col" class="text-center">Jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row" class="text-center">1</th>
                                <td colspan="2">Jumlah Peminjaman Buku pada Bulan ini:</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">a) &nbsp;Peminjaman oleh Guru</td>
                                <td class="text-center">{{$borrow_teacher}} Peminjaman</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">b) &nbsp;Peminjaman oleh Siswa</td>
                                <td class="text-center">{{$borrow_student}} Peminjaman</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">c) &nbsp;Total Peminjaman</td>
                                <td class="text-center">{{$borrow_teacher + $borrow_student}} Peminjaman</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">2</th>
                                <td colspan="2">Jumlah Pengembalian Buku pada Bulan ini:</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">a) &nbsp;Jumlah Pengembalian Tepat Waktu</td>
                                <td class="text-center">{{$return_on_time}} Pengembalian</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">b) &nbsp;Jumlah Pengembalian Terlambat</td>
                                <td class="text-center">{{$return_late}} Pengembalian</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">c) &nbsp;Total Pengembalian</td>
                                <td class="text-center">{{$return_on_time + $return_late}} Pengembalian</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">3</th>
                                <td colspan="2">Jumlah Pengajuan Penggunaan Ebook pada Bulan ini:</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">a) &nbsp;Jumlah Pengajuan Diterima</td>
                                <td class="text-center">{{$accepted_request}} Pengajuan</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">b) &nbsp;Jumlah Pengajuan Ditolak</td>
                                <td class="text-center">{{$refused_request}} Pengajuan</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center"></th>
                                <td class="pl-5">c) &nbsp;Total Pengajuan</td>
                                <td class="text-center">{{$accepted_request + $refused_request}} Pengajuan</td>
                            </tr>
                            </tbody>
                        </table>
        
                        <div class="more-info mt-3">
                            <small>Dicetak oleh : {{auth()->user()->name}} ({{auth()->user()->role}}/{{auth()->user()->nomor_induk}})</small>
                        </div>
                    </div>
                    <div class="footer p-4 text-center text-white">
                        Perpustakaan SMKN 1 Cimahi &copy; 2020
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script>
        const load = document.querySelector('#load');
        $(document).on('click','#print-pdf',function(){

            load.classList.remove('d-none');
            load.classList.add('d-inline-block');
            
        })
    </script>
@endsection