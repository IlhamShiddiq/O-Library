@extends('../templates/admin')

@section('more-meta')
    <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Data Artikel')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/article-management') }}">Artikel</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4 p-0">
                <div class="gray-wrapper radius-admin mt-5">
                    <div class="info-login-pic text-center border-bottom pb-2">
                        <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="70" height="70">
                    </div>
                    <div class="info-login text-center pt-1">
                        <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                        <span class="badge badge-success">{{auth()->user()->role}}</span>
                    </div>
                </div>
                <div class="gray-wrapper radius-admin">
                    <form action="{{url('/article-management/search')}}" method="post">
                        @csrf
                        <div class="form-row">
                          <div class="col-12">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                          </div>
                        </div>
                    </form>
                    <a href="{{ url('/article-management') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{url('/article-management/create')}}" class="btn btn-success full-width"><i class="fas fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="total-row text-center p-3 border-bottom mb-3">
                    {{$count}} Data Ditampilkan
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Artikel</h1>
                @foreach ($articles as $article)
                    <div class="article-item-wrapper full-width position-relative shadow mb-3">
                        <div class="article-item position-absolute full-width py-2">
                            <div class="position-absolute top-absolute py-2 full-height">
                                <div class="position-relative full-width full-height">
                                    <img src="{{asset('uploaded_files/article-image/'.$article->image)}}" alt="Image" class="article-img pl-2 full-height fit-cover">
                                </div>
                            </div>
                            <div class="article-info full-width full-height position-relative pr-3">
                                <p class="title-info mt-2">{{$article->title}}</p>
                                <div class="last-updated mb-3 mt-1"><i class="far fa-clock"></i> Terakhir diupdate pada {{$article->updated_at}}</div>
                            </div>
                        </div>
                        <div class="button-wrapper position-absolute">
                            <a href="{{url('/article-management/edit/'.$article->id)}}" class="btn btn-sm btn-success">Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$article->id}}">Hapus</button>
                            <a href="{{url('articles/view/'.$article->id)}}" class="btn btn-sm btn-dark">Detail</a>
                        </div>
                        <div class="position-absolute private-sign">
                            @if ($article->public == '1')
                                <div class="spinner-grow text-success spinner-grow-sm" role="status"></div>
                            @else
                                <div class="spinner-grow text-danger spinner-grow-sm" role="status"></div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hapus Modal -->
    <div class="modal modal-admin fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title py-2" id="exampleModalLabel">PLEASE CONFIRM..</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-3 text-center">
                    <h2>Yakin ingin Menghapus Data?</h2>
                    <p class="pt-2">Data yang dihapus tidak akan bisa<br>dipulihkan kembali.</p>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <div class="form-hapus d-inline-block"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let modal = $(this)

            modal.find('.form-hapus').html(`
                                            <form action="{{url('/article-management/delete/${id}')}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                            </form>`)
        });
    </script>
@endsection