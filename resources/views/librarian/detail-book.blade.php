@extends('../templates/admin')

@section('title', 'Detail Buku')


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/book') }}">Book</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
        <li class="breadcrumb-item active" aria-current="page">{{$data->id}}</li>
    </ol>
@endsection

@section('content')
    <div class="detail-for-member full-width">
        <div class="book-detail-for-member">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 col-lg-4 p-2">
                        <div class="gray-wrapper radius-admin">
                            <div class="text-center border-bottom pb-2">
                                <img src="{{asset('uploaded_files/book-cover/'.$data->image)}}" alt="{{$data->title}}" class="fit-cover full-width">
                            </div>
                            <div class="text-center pt-1">
                                <p class="m-1">Kuantitas tersedia : {{$data->qty}} buku</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6 p-3">
                        <div class="detail-book-title p-2 border-bottom"><h1>{{$data->title}}</h1></div>
                        <div class="detail-buku-data p-2">
                            <div class="detail-buku-kategori mt-2 mb-3">
                                <span class="badge badge-success py-2 px-4">{{$data->category}}</span>
                                <span class="badge badge-info py-2 px-3 text-white">ISBN : {{$data->isbn}}</span>
                                <span class="badge badge-primary py-2 px-3">{{$data->publish_year}}</span>
                            </div>
                            <p class="sinopsis">{{$data->about}}</p>
                            <div class="gray-wrapper p-2 bold">
                                Ditulis oleh {{$data->author}}
                            </div>
                            <div class="gray-wrapper p-2 bold">
                                Diterbitkan oleh {{$data->publisher}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection