@extends('../templates/admin')

@section('more-css')
    <link rel="stylesheet" href="css/calendar.css">
@endsection

@section('title', 'Dashboard')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="dashboard-container">
            <div class="row mb-3">
                <div class="col col-12 col-lg-9">
                    <div class="about-user radius-admin gray-bg">
                        <div class="container-fluid py-1">
                            <div class="row">
                                <div class="col-md-6 col-lg-7">
                                    <img src="img/vectors/vector-3.png" alt="vector" class="vector">
                                </div>
                                <div class="col-md-6 col-lg-5 text-center">
                                    <div class="foto-user text-center mt-2">
                                        <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham" height="90" width="90" class="rounded-circle fit-cover">
                                    </div>
                                    <div class="greeting-user text-center mt-1 mb-3 py-2">
                                        <h1>Halo, {{auth()->user()->username}}</h1>
                                        @auth
                                            
                                        <p>Anda login sebagai {{auth()->user()->role}}</p>
                                        @endauth
                                    </div>
                                    <a href="{{url('/guide')}}" class="badge badge-success px-3 mt-2"><i class="fas fa-lightbulb"></i> Baca panduan halaman admin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-lg-3">
                    <div class="calendar radius-admin gray-bg p-0" id="calendar">
                        
                    </div>
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col col-11 col-md-6 col-lg-4">
                    <div class="transaction-graphic radius-admin gray-bg bg-graphic">
                        <canvas id="transaction" width="400" height="400"></canvas>
                    </div>
                </div>
                <div class="col col-11 col-md-6 col-lg-5 position-relative">
                    <div class="more-graphic radius-admin gray-bg bg-graphic">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 pl-1">
                                    <div class="librarian-grap p-0">
                                        <canvas id="admin" height="460"></canvas>
                                    </div>
                                </div>
                                <div class="col-6 pr-1">
                                    <div class="member-grap p-0">
                                        <canvas id="member" height="460"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-absolute full-width py-3 px-3">
                        <div class="container-fluid">
                            <div class="total-more-graphic radius-admin mb-2">
                                <div class="row">
                                    <div class="col-6 text-center p-2">
                                        <span class="badge badge-light px-4 py-1">Total : {{$sum_librarians}}</span>
                                    </div>
                                    <div class="col-6 text-center p-2">
                                        <span class="badge badge-light px-4 py-1">Total : {{$sum_members}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-11 col-md-9 col-lg-3 col-info">
                    <div class="info radius-admin bg-graphic">
                        <div class="info-item info-item-buku">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-9 col-lg-7 text-white">
                                        <h1>Jumlah Buku</h1>
                                        <p class="ml-2">{{$sum_books}}</p>
                                    </div>
                                    <div class="col-3 col-lg-5">
                                        <div class="icon icon-buku text-white text-center">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item info-item-ebook my-3">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-9 col-lg-7 text-white">
                                        <h1>Jumlah Ebook</h1>
                                        <p class="ml-2">{{$sum_ebooks}}</p>
                                    </div>
                                    <div class="col-3 col-lg-5">
                                        <div class="icon icon-ebook text-white text-center">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item info-item-kategori">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-9 col-lg-7 text-white">
                                        <h1>Jumlah Kategori</h1>
                                        <p class="ml-2">{{$sum_categories}}</p>
                                    </div>
                                    <div class="col-3 col-lg-5">
                                        <div class="icon icon-kategori text-white text-center">
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script src="js/calendar.js"></script>
    <script>
        let cal = $('#calendar');
        let calendar = new Calendar(cal);

        let transactionGraphic = document.getElementById('transaction');
        let adminGraphic = document.getElementById('admin');
        let memberGraphic = document.getElementById('member');

        let TransactionGraphic = new Chart(transactionGraphic, {
            type: 'bar',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at'],
                datasets: [{
                    label: 'Jumlah transaksi',
                    data: [{{$monday_transaction}}, {{$tuesday_transaction}}, {{$wednesday_transaction}}, {{$thursday_transaction}}, {{$friday_transaction}}],
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                    ],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Jumlah peminjaman minggu ini'
                }
            }
        });

        let AdminGraphic = new Chart(adminGraphic, {
            type: 'doughnut',
            data: {
                labels: ['Admin', 'Pustakawan'],
                datasets: [{
                    label: 'Jumlah',
                    data: [<?php echo $sum_adms; ?>, <?php echo $sum_libs; ?>],
                    backgroundColor: [
                        'rgb(48, 141, 56)',
                        'rgb(79, 207, 90)',
                    ],
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Jumlah pustakawan'
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        });

        let MemberGraphic = new Chart(memberGraphic, {
            type: 'doughnut',
            data: {
                labels: ['Guru', 'Siswa'],
                datasets: [{
                    label: 'Jumlah',
                    data: [<?php echo $sum_teacher; ?>, <?php echo $sum_student; ?>],
                    backgroundColor: [
                        'rgb(79, 207, 90)',
                        'rgb(48, 141, 56)',
                    ],
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Jumlah anggota'
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 20,
                        bottom: 20
                    }
                }
            }
        });
    </script>
@endsection