@extends('../templates/member')

@section('title', 'My Ebook')

@section('breadcrumb')
    <div class="col-lg-12 col-md-12 col-12">
        <div class="breadcrumb-container">
            <ol class="breadcrumb position-relative">
                <div class="breadcrumb-title position-absolute top-absolute text-center text-white">MY EBOOK</div>
                <li class="breadcrumb-item active" aria-current="page">Member</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/my-ebook')}}">My Ebook</a></li>
                <li class="breadcrumb-item active" aria-current="page">Preview</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 col-md-10 col-12 preview-pdf-ebook">
        <div class="judul-preview-ebook pt-2"> </div>
        <div class="preview-pdf position-relative full-width mt-1">
            <iframe src="{{$link}}" class="full-width position-absolute top-absolute" frameborder="1">
            </iframe>
            <div class="position-absolute p-1 rounded" style="background-color: #d1d1d1; top: 14px; right: 14px;"><img src="{{asset('img/icon.png')}}" width="60" height="60"></div>
        </div>
        <div class="info-ebook mt-4 mb-4 full-width text-center">
            Berlaku hingga {{$ebooks[0]->limit_date}}
        </div>
    </div>
@endsection