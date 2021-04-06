@extends('../templates/base')

@section('title', "Articles")

@section('content')
    <nav class="navbar navbar-article-page navbar-expand-lg navbar-dark position-absolute top-absolute full-width">
        <div class="container-fluid py-3 px-4">
            <h3 class="text-white">Artikel</h3>
        </div>
    </nav>
    <div class="heading-articles full-width position-relative" style="background-image: url({{asset('img/bg-article-page.jpg')}})">
        <div class="overlay-article position-absolute top-absolute full-width p-5"></div>
        <div class="titles-heading position-absolute full-width">
            <div class="title-heading text-center text-white mt-4 mb-1">KUMPULAN ARTIKEL PERPUSTAKAAN SMK NEGERI 1 CIMAHI</div>
            <div class="quote-reading text-white text-center">"Membaca adalah napas hidup dan jembatan emas ke masa depan."</div>
            <div class="text-center mt-3">
                <a href="{{url('/articles')}}" style="{{$style_unauth}}" class="btn btn-success px-4 rounded-pill m-auto">Kembali ke Halaman Artikel</a>
                <a href="{{url('/article-management')}}" style="{{$style_auth}}" class="btn btn-success px-4 rounded-pill m-auto">Kembali</a>
            </div>
        </div>
    </div>
    <div class="gray-section full-width"></div>
    <div class="article-item mb-5">
        <div class="container">
            <div class="row pt-3">
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="article full-width">
                        <img src="{{asset('uploaded_files/article-image/'.$article->image)}}" alt="Article Image" class="img-article full-width fit-cover">
                        <h1 class="article-title mt-4">{{$article->title}}</h1>
                        <p class="last-updated-article mb-4"><i class="far fa-clock"></i> Terakhir diupdate pada {{$article->updated_at}}</p>
                        <div class="article-content">
                            {!!$article->content!!}
                        </div>
                        <p class="written-by mt-2"><i class="fas fa-user"></i> Ditulis oleh {{$article->written_by}}</p>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="sidebar-article full-width">
                        <button class="btn btn-dark full-width rounded-0 text-left">CARI ARTIKEL</button>
                        <div class="form-search p-3">
                            <form action="{{url('/articles/search')}}" method="POST">
                                @csrf
                                <div class="input-group full-width">
                                    <input type="text" class="form-control pl-3" placeholder="Search Article" name="search" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                    <button type="submit" class="btn btn-success pr-3" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <button class="btn btn-dark full-width rounded-0 text-left">ARTIKEL TERBARU</button>
                        <div class="p-3">
                            <ol class="latest-article">
                                @foreach ($latest_article as $latest)
                                    <li><a href="{{url('/articles/view/'.$latest->id)}}">{{$latest->title}}</a></li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center text-white footer-lp mt-3">
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