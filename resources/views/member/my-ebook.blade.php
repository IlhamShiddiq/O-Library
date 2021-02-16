@extends('../templates/member')

@section('title', 'My Ebook')

@section('breadcrumb')
    <div class="col-lg-12 col-md-12 col-12">
        <div class="breadcrumb-container breadcrumb-container-member">
            <ol class="breadcrumb position-relative">
                <div class="breadcrumb-title position-absolute top-absolute text-center text-white">MY EBOOK</div>
                <li class="breadcrumb-item active" aria-current="page">Member</li>
                <li class="breadcrumb-item"><a href="{{asset('/member/my-ebook')}}">My Ebook</a></li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="explain-my-ebook p-2 rounded text-center mb-3" style="background-color: rgb(240, 240, 240)">
            Halo, halaman ini adalah halaman yang berisi daftar ebook yang pernah anda ajukan.
        </div>
    </div>
    @foreach ($ebooks as $ebook)
        <div class="col-lg-3 col-md-5 col-10 mb-4">
            <div class="card card-book" style="width: 100%;">
                <img src="{{asset('uploaded_files/ebook-cover/'.$ebook->image)}}" class="full-width fit-cover-top" alt="...">
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
                                <span href="#" class="badge badge-danger px-2 py-1 rounded-circle mr-2" style="cursor: pointer" data-toggle="modal" data-target="#refusedModal" data-reason="{{$ebook->reason_for_rejection}}"><i class="fas fa-info"></i></span>
                                <a href="{{url('/member/ebook/detail/'.$ebook->id)}}" class="btn d-inline-block text-white rounded-0 px-4">
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
                                <small style="color: red; font-style: italic; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Anda dapat menggunakan ebook sampai batas waktu pemakaian.">Berlaku hingga {{$ebook->limit_date}}</small>
                            @else
                                <small style="color: red; font-style: italic; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Penggunaan ebook telah melewati batas pemakaian.">Sudah melewati batas waktu</small>
                            @endif
                        @else
                            <small style="color: red; font-style: italic; font-weight: bold; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Pustakawan menolak ajuan anda, periksa apa alasan penolakan ini.">Ajuan ditolak</small>
                        @endif
                    @else
                        <small style="color: rgb(206, 206, 27); font-style: italic; cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Pustakawan belum mengambil tindakan mengenai ajuan ebook anda">Menunggu konfirmasi</small>&nbsp;
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <!-- Refused Modal -->
    <div class="modal modal-admin fade" id="refusedModal" tabindex="-1" aria-labelledby="editDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <h5>ALASAN PENOLAKAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-4">
                    <div class="reason text-center"></div>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script>
        $('#refusedModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var reason = button.data('reason') 
            var modal = $(this)
            modal.find('.reason').html(reason)
        })

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection