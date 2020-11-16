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
                <li class="breadcrumb-item"><a href="{{asset('/member/ebook')}}">10</a></li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="detail">
        <div class="row full-width justify-content-center pb-3 border-bottom">
            <div class="col-lg-4 col-md-6 col-11">
                <img src="{{asset('img/coba3.jpg')}}" alt="" class="full-width fit-cover-top mb-3">
            </div>
            <div class="col-lg-6 col-md-6 col-11">
                <div class="detail-wrapper position-relative">
                    <div class="gray-line position-absolute top-absolute full-width pt-1"></div>
                    <h1 class="judul border-bottom py-3 px-2">ini judul yang akan tertera disini</h1>
                    <h5 class="kategori"><span class="badge badge-secondary px-3 ml-2">Komputer dan Internet</span></h5>
                    <div class="profile-buku pl-2 my-4 border-bottom">
                        <p class="profile">Diterbitkan oleh Ini nama penerbit</p>
                        <p class="profile">Ditulis oleh ini nama penulis</p>
                    </div>
                    <p class="tentang text-justify pl-2 pr-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias laboriosam rem vel provident, neque doloribus, atque harum commodi blanditiis facere est nobis voluptatum corporis officiis natus dolores totam dolorem. Maiores.</p>
                    
                    <div class="btn-ajuan-wrapper ml-2">
                        <button type="button" class="btn btn-sm btn-ajuan mt-3 px-3 rounded-0 text-white mb-3" data-toggle="modal" data-target="#ajuanModal"><span>Ajukan Penggunaan Ebook</span></button>
                    </div>
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
                    <form>
                        <div class="form-group">
                          <small>Alasan pengajuan</small>
                          <textarea class="form-control" placeholder="Masukkan disini" rows="3"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm mb-2 px-5 btn-primary rounded-0">Submit</button>
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