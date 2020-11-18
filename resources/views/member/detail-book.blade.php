@extends('../templates/member')

@section('title', 'Detail Buku')

@section('breadcrumb')
    <div class="col-12">
        <div class="breadcrumb-container">
            <ol class="breadcrumb position-relative">
                <div class="breadcrumb-title position-absolute top-absolute text-center text-white">DETAIL BUKU</div>
                <li class="breadcrumb-item active" aria-current="page">Member</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/book')}}">Book</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/book/detail/'.$datas[0]->id)}}">{{$datas[0]->id}}</a></li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="detail">
        <div class="row full-width justify-content-center pb-3 border-bottom">
            <div class="col-lg-4 col-md-6 col-11 mb-3">
                <img src="{{asset('uploaded_files/book-cover/'.$datas[0]->image)}}" alt="{{$datas[0]->title}}" class="full-width fit-cover-top mb-3">
            </div>
            <div class="col-lg-6 col-md-6 col-11">
                <div class="detail-wrapper position-relative">
                    <div class="gray-line position-absolute top-absolute full-width pt-1"></div>
                    <h1 class="judul border-bottom py-3 px-2">{{$datas[0]->title}}</h1>
                    <h5 class="kategori"><span class="badge badge-secondary px-3 ml-2">{{$datas[0]->category}}</span></h5>
                    <div class="profile-buku pl-2 my-4 border-bottom">
                        <p class="profile">Diterbitkan oleh {{$datas[0]->publisher}}</p>
                        <p class="profile">Ditulis oleh {{$datas[0]->author}}</p>
                    </div>
                    <p class="tentang text-justify pl-2 pr-5">{{$datas[0]->about}}</p>

                    @if ($datas[0]->qty == 0)
                        <span class="badge badge-danger mt-3 px-3 ml-2 mb-3">Tidak Tersedia</span>
                    @else
                        <span class="badge badge-success mt-3 px-3 ml-2 mb-3">Tersedia</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-content')
    <div class="full-width">
        <div class="ibsn-buku px-3 py-2 text-center text-white mb-4">
            ISBN : 002-30-0201-010
        </div>
    </div>
@endsection