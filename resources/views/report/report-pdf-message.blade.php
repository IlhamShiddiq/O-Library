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
        <div class="col-lg-6 col-md-9 col-11">
            <div class="message-report-wrapper py-4 mt-5">
                <form action="{{url('/pdf-report')}}" method="post">
                    @csrf
                    <h5 class="text-center mb-2">Catatan Untuk Laporan Bulan Ini</h5>
                    <div class="form-group">
                      <textarea class="form-control" rows="5" name="message" placeholder="Masukkan teks disini"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success px-4 full-width mb-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
@endsection