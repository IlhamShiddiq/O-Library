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
                <button id="print-card" class="btn btn-sm btn-success"><i class="fas fa-download"></i></button>
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
                                    <img src="{{asset('img/photo.png')}}" alt="Foto" class="rounded-circle object-fit" style="border-radius: 100%;">
                                </div>
                                <div class="name-wrapper">
                                    <div class="name">
                                        <h1>ilham shiddiq</h1>
                                        <h2>Kartu Anggota</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                Perpustakaan SMKN 1 Cimahi
                            </div>
                        </div>
                        <div class="member-card shadow border belakang">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script>
        const load = document.querySelector('#load');
        $(document).on('click','#print-card',function(){

            load.classList.remove('d-none');
            load.classList.add('d-inline-block');

            let pdf = new jsPDF();
            let section=$('.cetak-kartu');
            let page= function() {
                pdf.save('Kartu Anggota');
            
            };

            pdf.addHTML(section,page);
            

        })
    </script>
@endsection