@extends('templates/base')

@section('title', 'About Developer')

@section('content')
    <div class="about-dev-wrapper full-width">
        <div class="header full-width position-relative text-white">
            <h1>About Developer</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="line-report mt-5 mb-1"></div>
                    <div class="text-center text-white p-2 mb-3 month-report-info">
                        ILHAM SHIDDIQ
                    </div>
                    <div class="gray-wrapper radius-admin mb-3">
                        <div class="info-login-pic text-center border-bottom pb-2">
                            <img src="{{asset('img/developer.png')}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="100" height="100">
                        </div>
                        <div class="info-login text-center pt-1">
                            <p class="m-1">Pelajar di SMKN 1 Cimahi</p>
                        </div>
                    </div>
                    <a href="https://github.com/IlhamShiddiq/" class="btn btn-sm btn-github text-white full-width mb-1"  target="_blank" rel="noopener"><i class="fab fa-github"></i> Github</a>
                    <a href="https://www.instagram.com/ilham_shiddiq373/" class="btn btn-sm btn-ig text-white full-width mb-1" target="_blank" rel="noopener"><i class="fab fa-instagram"></i> Instagram</a>
                    <a href="https://www.linkedin.com/in/ilham-shiddiq-63858a1a7" class="btn btn-sm btn-primary full-width mb-1" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                    <a href="https://api.whatsapp.com/send?phone=6287747961912" class="btn btn-sm btn-success full-width mb-1" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                    <button class="btn btn-sm btn-success full-width mb-1"><i class="fas fa-envelope"></i> Email : shdqillham123@gmail.com</button>
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="gray-wrapper radius-admin mt-5">
                        <div class="border"></div>
                        <div class="about-me p-3">
                            <h2 class="intro">Introducing</h2>
                            Hallo, perkenalkan nama saya Ilham Shiddiq. Saya masih duduk di bangku sekolah kelas XII (12) di SMK Negeri 1 Kota Cimahi, Kompetensi Keahlian Rekayasa Perangkat Lunak (RPL). Lahir di Cimahi, 03 Juli 2003. Tinggal di Kota Cimahi, Kelurahan Padasuka. Tertarik pada bidang web developer, terutama untuk bagian Backend.
                        </div>
                    </div>
                    <button class="btn btn-gray text-white full-width mb-2" type="button" data-toggle="collapse" data-target="#pendidikan" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chevron-down"></i> Riwayat Pendidikan
                    </button>
                    <div class="collapse mb-2" id="pendidikan">
                        <div class="gray-wrapper radius-admin">
                            <div class="border"></div>
                            <div class="pendidikan pt-3 pl-3">
                                <h4>Riwayat Pendidikan</h4>
                                <ol>
                                    <li>TK Al-Quran Nuurul Hikmah Kota Cimahi</li>
                                    <li>SD Negeri Padasuka Mandiri 2 Kota Cimahi</li>
                                    <li>SMP Negeri 3 Kota Cimahi</li>
                                    <li>SMK Negeri 1 Kota Cimahi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-gray text-white full-width mb-2" type="button" data-toggle="collapse" data-target="#prestasi" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chevron-down"></i> Prestasi
                    </button>
                    <div class="collapse mb-2" id="prestasi">
                        <div class="gray-wrapper radius-admin">
                            <div class="border"></div>
                            <div class="pendidikan pt-3 pl-3">
                                <h4>Prestasi</h4>
                                <ol>
                                    <li>Juara Lomba Programming Universitas Widyatama</li>
                                    <li>Kontributor Lomba Kihajar Game Mobile Tahun 2020</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-gray text-white full-width mb-2" type="button" data-toggle="collapse" data-target="#karya" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-chevron-down"></i> Karya
                    </button>
                    <div class="collapse mb-2" id="karya">
                        <div class="gray-wrapper radius-admin">
                            <div class="border"></div>
                            <div class="pendidikan pt-3 pl-3">
                                <h4>Karya</h4>
                                <div class="card full-width mb-2">
                                    <img src="{{asset('img/karya-dev/wingstone.png')}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <p class="card-text">Pengerjaan web company profile, dapat dilihat <a href="https://cafe-website-42f45.web.app/" target="_blank" rel="noopener">disini</a></p>
                                    </div>
                                </div>
                                <div class="card full-width mb-2">
                                    <img src="{{asset('img/karya-dev/happy-rest.png')}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <p class="card-text">Pengerjaan web restaurant yang datanya berasal dari API, pengerjaan submission dari course Dicoding, dapat dilihat <a href="https://happyrestaurant373.web.app/" target="_blank" rel="noopener">disini</a></p>
                                    </div>
                                </div>
                                <div class="card full-width mb-2">
                                    <img src="{{asset('img/karya-dev/corona.png')}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <p class="card-text">Pengerjaan web corona infected yang datanya berasal dari API, pengerjaan submission dari course Dicoding, dapat dilihat <a href="https://covid-19-57829.web.app/" target="_blank" rel="noopener">disini</a></p>
                                    </div>
                                </div>
                                <div class="card full-width mb-4">
                                    <img src="{{asset('img/karya-dev/abumi.png')}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <p class="card-text">Pengerjaan web quiz Abumi yang dibuat menggunakan PHP Native, dapat dilihat <a href="http://abumi-quiz.000webhostapp.com/" target="_blank" rel="noopener">disini</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center text-white footer-lp">
        <div class="container">
            <div class="row my-4">
                <div class="col-lg-4 col-md-6 col-12 text-left">
                    <h5 class="mb-3 brand">O'Library.</h5>
                    <p class="text-justify pr-3">Web resmi perpustakaan milik SMK Negeri 1 Kota Cimahi. Hanya dapat diakses oleh siswa dan guru SMK Negeri 1 Cimahi.</p>
                    <p class="email"><i class="far fa-envelope"></i> perpustakaansmkn01@gmail.com</p>
                    <p class="address mt-3">Jalan Maharmartanegara No 48, Kelurahan Leuwigajah</p>
                </div>
                <div class="col-lg-2 col-md-6 col-12 text-left">
                    <h5 class="mb-3">Pintasan</h5>
                    <ul>
                        <li><a href="{{url('/#info')}}">Info Perpustakaan</a></li>
                        <li><a href="{{url('/#galeri')}}">Galeri</a></li>
                        <li><a href="{{url('/account/confirm')}}">Konfirmasi Akun</a></li>
                        <li><a href="{{url('/login')}}">Login</a></li>
                        <li><a href="{{url('/about-dev')}}">About Developer</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-12 text-left">
                    <h5 class="mb-3">Jam Buka</h5>
                    <table class="full-width">
                        <tr>
                            <td class="day">Senin</td>
                            <td class="time">08.00 - 17.00</td>
                        </tr>
                        <tr>
                            <td class="day">Selasa</td>
                            <td class="time">08.00 - 17.00</td>
                        </tr>
                        <tr>
                            <td class="day">Rabu</td>
                            <td class="time">08.00 - 17.00</td>
                        </tr>
                        <tr>
                            <td class="day">Kamis</td>
                            <td class="time">08.00 - 17.00</td>
                        </tr>
                        <tr>
                            <td class="day">Jumat</td>
                            <td class="time">08.00 - 17.00</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4 col-md-6 col-12 text-left">
                    <h5 class="mb-3">Tentang</h5>
                    <p class="text-justify">O'Library merupakan web perpustakaan online yang digunakan sebagai portal untuk siswa untuk mengakses perbukuan yang tersedia di perpustakaan SMK Negeri 1 Cimahi.</p>
                </div>
            </div>
        </div>
        O'Library &copy; 2020, SMKN 1 Cimahi
    </footer>
@endsection