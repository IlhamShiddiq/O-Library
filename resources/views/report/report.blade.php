<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .pdf-report-wrapper {
            width: 100%;
            margin: auto;
        }
        .pdf-report-wrapper .line-green {
            padding-top: 3px;
            background-color:#269b72;
        }
        .pdf-report-wrapper .pdf-report {
            width: 100%;
            margin: auto;
            font-family: segoe;
            background-color: #fff;
        }
        .pdf-report-wrapper .pdf-report .header {
            background-color:#269b72;
            color: white;
            padding: 2rem;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .pdf-report-wrapper .pdf-report .header h1.title {
            font-size: 34px;
            letter-spacing: 2px;
            text-align: center;
        }
        .pdf-report-wrapper .pdf-report .header h2.sub-title {
            font-size: 20px;
            margin-top: -15px;
            text-align: center;
        }
        .pdf-report-wrapper .pdf-report .info {
            border-bottom: 4px solid #3AAF87;
            font-size: 16px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .pdf-report-wrapper .pdf-report .konten table {
            width: 90%;
            margin: auto;
            border: 1px solid rgb(204, 204, 204);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        .pdf-report-wrapper .pdf-report .konten table thead {
            background-color:#0f6b3d;
        }
        .pdf-report-wrapper .pdf-report .konten table thead tr th {
            color: white;
            padding: 20px 0;
        }
        .pdf-report-wrapper .pdf-report .konten table tbody tr td {
            padding: 9px 10px;
            font-size: 14px;
        }
        .pdf-report-wrapper .pdf-report .footer {
            background-color:#269b72;
            text-align: center;
            padding: 1.4rem;
            color: white;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        small {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
    </style>
</head>
<body>

    <div class="pdf-report-wrapper">
        <div class="pdf-report">
            <div class="header">
                <h1 class="title">LAPORAN TRANSAKSI</h1>
                <h2 class="sub-title">Perpustakaan SMK Negeri 1 Kota Cimahi</h2>
            </div>
            <div class="info" style="padding: 1.5rem 3rem 1.5rem 3rem;">
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
            <div class="konten" style="padding: 1.5rem; margin: 1rem 0;">
                <table class="table table-bordered" border="1" cellspacing="0">
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

                <div class="more-info" style="margin-top: 1.8rem; margin-left: 1rem;">
                    <small>Dicetak oleh : {{auth()->user()->name}} ({{auth()->user()->role}}/{{auth()->user()->nomor_induk}})</small>
                </div>
            </div>
            <div class="footer">
                Perpustakaan SMKN 1 Cimahi &copy; 2020
            </div>
        </div>
    </div>
    
</body>
</html>