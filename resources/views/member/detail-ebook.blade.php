@extends('../templates/member')

@section('title', 'Detail Ebook')

@section('breadcrumb')
    <div class="col-12">
        <div class="breadcrumb-container">
            <ol class="breadcrumb position-relative">
                <div class="breadcrumb-title position-absolute top-absolute text-center text-white">DETAIL EBOOK</div>
                <li class="breadcrumb-item active" aria-current="page">Member</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/ebook')}}">Ebook</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/ebook/detail/'.$data->id)}}">{{$data->id}}</a></li>
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
                                <img src="{{asset('uploaded_files/ebook-cover/'.$data->image)}}" alt="{{$data->title}}" class="fit-cover full-width">
                            </div>
                            <div class="text-center pt-1">
                                <button type="button" class="btn btn-sm btn-dark mt-3 px-3 rounded-0 text-white full-width mb-3" data-toggle="modal" data-target="#ajuanModal"><span>Ajukan Penggunaan Ebook</span></button>
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

@section('more-modal')
    <!-- Ajuan Modal -->
    <div class="modal modal-admin fade" id="ajuanModal" tabindex="-1" aria-labelledby="editDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <h5>PENGAJUAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-4">
                    <form action="{{'/member/ebook/permission/'.$data->id}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <small>Alasan pengajuan</small>
                            <textarea class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" placeholder="Isikan disini..." rows="3"></textarea>
                            @error('alasan')
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm mb-2 px-5 btn-primary rounded-0">Submit</button>
                            <div>
                                <small class="text-left">Mohon berikan alasan yang jelas mengenai pengajuan pemakaian ebook. <span style="font-weight: bold;">Alasan yang bersifat asal-asalan dan tidak jelas akan langsung ditolak oleh Admin.</span></small><br>
                                <small class="text-left"><span style="font-weight: bold;">Ajuan akan di proses 1x24 jam, tidak termasuk hari libur.</span></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>
@endsection