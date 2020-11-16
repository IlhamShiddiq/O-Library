@extends('../templates/member')

@section('title', 'Daftar Ebook')

@section('breadcrumb')
    <div class="col-lg-9 col-md-7 col-12">
        <div class="breadcrumb-container">
            <ol class="breadcrumb position-relative">
                <div class="breadcrumb-title position-absolute top-absolute text-center text-white">DATA EBOOK</div>
                <li class="breadcrumb-item active" aria-current="page">Member</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/ebook')}}">Ebook</a></li>
            </ol>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-12">
        <div class="form-search">
            <form action="">
                <div class="input-group full-width">
                    <input type="text" class="form-control pl-3" placeholder="Search" aria-describedby="button-addon2">
                    <div class="input-group-append">
                    <button class="btn btn-success pr-3" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba3.jpg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-10 mb-4">
        <div class="card card-book" style="width: 100%;">
            <img src="{{asset('img/coba4.jpeg')}}" class="full-width fit-cover" alt="...">
            <div class="card-body position-relative">
            <h5 class="judul-buku">ini judul buku yang tertera</h5>
            <div class="btn-wrapper position-absolute">
                <a href="#" class="btn text-white rounded-0 px-4">
                    <span>Detail Buku</span>
                </a>
            </div>
            </div>
        </div>
    </div>
@endsection