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
                <li class="breadcrumb-item"><a href="{{asset('/member/book/detail/'.$data->id)}}">{{$data->id}}</a></li>
            </ol>
        </div>
    </div>
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
                            <div class="gray-wrapper p-2 bold border rounded">
                                Ditulis oleh {{$data->author}}
                            </div>
                            <div class="gray-wrapper p-2 bold border rounded">
                                Diterbitkan oleh {{$data->publisher}}
                            </div>
                        </div>
                        <div class="book-history mt-3 mb-1">
                            <div class="book-history-tag-title px-4 py-2 mb-2 text-white text-center">
                                RIWAYAT PEMINJAMAN BULAN INI
                            </div>
                            <table class="table table-hover">
                                <thead class="table-dark">
                                  <tr>
                                    <th width="375" scope="col">Nama</th>
                                    <th scope="col">Role/Kelas</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td>{{$history->name}}</td>
                                            <td>{{$history->status}}/{{$history->class}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper position-relative full-width p-2 my-3">
                                {{$histories->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection