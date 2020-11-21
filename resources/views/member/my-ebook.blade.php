@extends('../templates/member')

@section('title', 'My Ebook')

@section('breadcrumb')
    <div class="col-lg-12 col-md-12 col-12">
        <div class="breadcrumb-container">
            <ol class="breadcrumb position-relative">
                <div class="breadcrumb-title position-absolute top-absolute text-center text-white">MY EBOOK</div>
                <li class="breadcrumb-item active" aria-current="page">Member</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/my-ebook')}}">My Ebook</a></li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    @foreach ($ebooks as $ebook)
        <div class="col-lg-3 col-md-5 col-10 mb-4">
            <div class="card card-book" style="width: 100%;">
                <img src="{{asset('uploaded_files/ebook-cover/'.$ebook->image)}}" class="full-width fit-cover" alt="...">
                <div class="card-body position-relative">
                    <h5 class="judul-buku">{{$ebook->title}}</h5>
                    <div class="btn-wrapper position-absolute">
                        @if ($ebook->confirmed == 1)
                            @if ($ebook->accepted == 1)
                                @if(!($ebook->limit_date < date('Y-m-d')))
                                    <a href="{{url('/member/my-ebook/preview/'.$ebook->id)}}" class="btn text-white rounded-0 px-4">
                                        <span>Buka Ebook</span>
                                    </a>
                                @else
                                    <a href="{{url('/member/ebook/detail/'.$ebook->id)}}" class="btn text-white rounded-0 px-4">
                                        <span>Detail Ebook</span>
                                    </a>
                                @endif
                            @else
                                <a href="{{url('/member/ebook/detail/'.$ebook->id)}}" class="btn text-white rounded-0 px-4">
                                    <span>Detail Ebook</span>
                                </a>
                            @endif
                        @else
                            <a href="{{url('/member/ebook/detail/'.$ebook->id)}}" class="btn text-white rounded-0 px-4">
                                <span>Detail Ebook</span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-footer pt-0 pb-1 text-center">
                    @if ($ebook->confirmed == 1)
                        @if ($ebook->accepted == 1)
                            @if(!($ebook->limit_date < date('Y-m-d')))
                                <small style="color: red; font-style: italic;">Berlaku hingga {{$ebook->limit_date}}</small>
                            @else
                                <small style="color: red; font-style: italic;">Sudah melewati batas waktu</small>
                            @endif
                        @else
                            <small style="color: red; font-style: italic; font-weight: bold;">Ajuan ditolak</small>
                        @endif
                    @else
                        <small style="color: rgb(235, 235, 28); font-style: italic;">Menunggu konfirmasi</small>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endsection