@extends('../templates/member')

@section('title', 'Daftar Buku')

@section('breadcrumb')
    <div class="col-lg-9 col-md-7 col-12">
        <div class="breadcrumb-container">
            <ol class="breadcrumb position-relative">
                <div class="breadcrumb-title position-absolute top-absolute text-center text-white">DATA BUKU</div>
                <li class="breadcrumb-item active" aria-current="page">Member</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/book')}}">Book</a></li>
            </ol>
        </div>
    </div>
    <div class="col-lg-3 col-md-5 col-12">
        <div class="form-search form-search-member-side">
            <form action="{{url('/member/book/search')}}" method="POST">
                @csrf
                <div class="input-group full-width">
                    <input type="text" class="form-control pl-3" placeholder="Search" name="search" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-success pr-3" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('content')
    @foreach ($books as $book)
        <div class="col-lg-3 col-md-5 col-10 mb-4">
            <div class="card card-book" style="width: 100%;">
                <div class="position-relaive">
                    <img src="{{asset('uploaded_files/book-cover/'.$book->image)}}" class="full-width fit-cover-top" alt="...">
                    @if ($book->qty == 0)
                        <div class="position-absolute top-absolute full-width no-stock">
                            <div class="position-relative full-width-width teks-wrapper">
                                <div class="teks position-absolute text-center">TIDAK TERSEDIA</div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body position-relative">
                    <h5 class="judul-buku" @if($book->qty == 0) style="color: red;" @endif>{{$book->title}}</h5>
                    <div class="btn-wrapper position-absolute">
                        <a href="{{url('/member/book/detail/'.$book->id)}}" class="btn text-white rounded-0 px-4">
                            <span>Detail Buku</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('pagination')
    <div class="row justify-content-center">
        <div class="col-12 text-center mb-2">
            <small class="counter-text">{{$counter}} Data Ditampilkan, Maks. 8 Data per Page</small>
        </div>
        <div class="col-12">
            <div class="pagination-wrapper position-relative full-width p-2 my-3">
                {{$books->links()}}
            </div>
        </div>
    </div>
@endsection