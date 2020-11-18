@extends('../templates/base')

@section('title', "O'Library")

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light nav-landing top-absolute">
        <div class="navbar-brand-container">
            <a class="navbar-brand" href="#">
                <img src="img/icon.png" alt="Icon" width="74">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link mx-3" href="#info">INFO</a>
                <a class="nav-link mx-3" href="#galeri">GALERI</a>
                <a class="btn btn-green mx-3 px-5 text-white" href="{{ url('/login') }}">LOGIN</a>
            </div>
        </div>
    </nav>
    <div class="page page-1">
        <div class="green-square bottom-absolute">
            <div class="address-container">
                <p class="text-white">Jalan Maharmartanegara Nomor 48, Kota Cimahi</p>
            </div>
        </div>
        <div class="vector">
            <div class="vector-1">
                <img src="img/vectors/vector.png" alt="Vector-1">
            </div>
            <div class="vector-2">
                <img src="img/vectors/vector-2.png" alt="Vector-2">
            </div>
        </div>
        <div class="words-1">
            <div class="container-fluid">
                <h1>O'LIBRARY</h1>
                <h2>SMKN 1 KOTA CIMAHI</h2>
                <p>Gudang ilmu berbasis online,<br> cari buku dan<br> download ebook</p>
                <a href="#info" class="btn btn-green text-white px-5"><i class="fas fa-arrow-down"></i> TELUSURI</a>
            </div>
        </div>
    </div>
    <div class="page page-2" id="info">
        <div class="green-square top-absolute"> </div>
        <div class="green-square-sm bottom-absolute"> </div>
        <div class="container-fluid">
            <div class="info-container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h1 class="title-page">INFORMASI DATA PERPUSTAKAAN</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-2 col-md-4 info-item info-item-green" data-aos="fade-down" data-aos-duration="800">
                        <div class="icon-item text-center">
                            <div class="icon-wrapper info-item-gray">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                        <div class="counter-data text-center text-white">
                            <div class="title mt-3">
                                <p>Jumlah<br>Buku</p>
                            </div>
                            <div class="value mt-4">
                                <p>{{$sum_books}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 info-item info-item-gray" data-aos="fade-up" data-aos-duration="800">
                        <div class="icon-item text-center text-white">
                            <div class="icon-wrapper info-item-green">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="counter-data text-center">
                            <div class="title mt-3" data-aos="fade-up">
                                <p>Jumlah<br>Ebook</p>
                            </div>
                            <div class="value mt-4">
                                <p>{{$sum_ebooks}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 info-item info-item-green" data-aos="fade-down" data-aos-duration="800">
                        <div class="icon-item text-center">
                            <div class="icon-wrapper info-item-gray">
                                <i class="fas fa-bookmark"></i>
                            </div>
                        </div>
                        <div class="counter-data text-center text-white">
                            <div class="title mt-3">
                                <p>Jumlah<br>Kategori</p>
                            </div>
                            <div class="value mt-4">
                                <p>{{$sum_categories}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-6 col-md-10 col-12 date-info info-item-gray text-center">
                        <p>Sesuai data hari Sabtu, tanggal 10 Oktober 2020</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page page-3" id="galeri">
        <div class="gallery-container">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h1 class="title-page">GALERI PERPUSTAKAAN</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-left" data-aos-duration="1000">
                        <div class="gallery-item"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-right" data-aos-duration="800">
                        <div class="gallery-item"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-left" data-aos-duration="1000">
                        <div class="gallery-item"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-right" data-aos-duration="800">
                        <div class="gallery-item"></div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-right" data-aos-duration="800">
                        <div class="gallery-item"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-left" data-aos-duration="1000">
                        <div class="gallery-item"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-right" data-aos-duration="800">
                        <div class="gallery-item"></div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2 col-gallery" data-aos="flip-left" data-aos-duration="1000">
                        <div class="gallery-item"></div>
                    </div>
                </div>
                <div class="row mt-5 mb-5">
                    <button class="btn btn-green btn-more-gallery text-white" type="button" data-toggle="collapse" data-target="#more-gallery" aria-expanded="false"id="show-more">
                        <i class="fas fa-arrow-down"></i> TAMPILKAN LEBIH BANYAK
                    </button>
                    <button class="btn btn-green btn-more-gallery text-white d-none" type="button" data-toggle="collapse" data-target="#more-gallery" aria-expanded="false" id="show-less">
                        <i class="fas fa-arrow-up"></i> TAMPILKAN LEBIH SEDIKIT
                    </button>
                </div>
                <div class="collapse mb-3" id="more-gallery">
                    <div class="card collapse-gallery card-body">
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 col-gallery">
                                <div class="gallery-item"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="green-square text-center text-white">
            <p>O'Library &copy; 2020, SMKN 1 Cimahi</p>
        </footer>
    </div>
    <div class="up-btn position-fixed" id="up-btn">
        <button class="btn text-center text-white rounded-circle"><i class="fas fa-arrow-up"></i></button>
    </div>
    <div class="wa-btn position-fixed">
        <a href="https://api.whatsapp.com/send?phone=6287747961912" class="btn text-white"><i class="fab fa-whatsapp"></i></a>
    </div>
    <div class="msg-btn position-fixed">
        <a href="https://m.me/ilham.shiddiq.1" class="btn text-white"><i class="fab fa-facebook-messenger"></i></a>
    </div>
@endsection

@section('more-js')
    <script src="{{asset('js/aos.js')}}"></script>
    <script src="{{asset('js/btn-landing-page.js')}}"></script>
@endsection