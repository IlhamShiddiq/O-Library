@extends('../templates/admin')

@section('title', 'Data Buku')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/book') }}">Book</a></li>
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
                    <form action="{{url('/book/search')}}" method="post">
                        @csrf
                        <div class="form-row">
                          <div class="col-4">
                            <div class="form-group">
                                <select class="form-control" name="by">
                                    <option value="title">Judul</option>
                                    <option value="publisher">Penerbit</option>
                                    <option value="author">Penulis</option>
                                    <option value="category">Kategori</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                          </div>
                        </div>
                    </form>
                    <a href="{{ url('/book') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
                </div>
                <div class="gray-wrapper radius-admin">
                    <div class="row">
                        <div class="col-7 pr-1">
                            <button type="button" class="btn btn-success full-width" data-toggle="modal" data-target="#addDataModal"><i class="fas fa-plus"></i> Tambah Data</button>
                        </div>
                        <div class="col-5 pl-1">
                          <button type="button" class="btn btn-primary full-width" data-toggle="modal" data-target="#exportDataModal"><i class="fas fa-file-upload"></i> Upload</button>
                        </div>
                    </div>
                </div>
                <div class="total-row text-center p-3 border-bottom mb-5">
                    {{$count}} Data Ditampilkan
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <h1 class="title-pagination text-center mb-3">Data Buku</h1>
                <div class="list-item">
                    @foreach ($books as $book)
                        <div class="item-table item-buku shadow">
                            <div class="item-table-header top-absolute">
                                <h1 class="judul text-white">{{$book->title}}</h1>
                            </div>
                            <div class="item-table-body">
                                <div class="row">
                                    <div class="col-6 col-md-8 col-lg-8">
                                        <span class="badge badge-secondary">{{$book->category}}</span>
                                        <p class="about mt-2">
                                            {{$book->about}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="image-buku">
                                <div class="image">
                                    <img src="{{asset('uploaded_files/book-cover/'.$book->image)}}" alt="{{$book->title}}" class="full-width full-height fit-cover">
                                </div>
                            </div>
                            <div class="btn-action bottom-absolute">
                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataModal" data-id="{{$book->id}}" data-isbn="{{$book->isbn}}" data-title="{{$book->title}}" data-category_id="{{$book->category_id}}" data-author="{{$book->author}}" data-publisher_id="{{$book->publisher_id}}" data-about="{{$book->about}}" data-terbit="{{$book->publish_year}}" data-qty="{{$book->qty}}" data-image="{{asset('uploaded_files/book-cover/'.$book->image)}}" data-nameimg="{{$book->image}}">Ubah</a>
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$book->id}}">Hapus</a>
                                <a href="{{ url('/book/history/'.$book->id) }}" class="btn btn-sm btn-info text-white">Riwayat</a>
                            </div>
                            <div class="item-table-footer bottom-absolute">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6 p-0">
                                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#detailDataModal" data-id="{{$book->id}}" data-title="{{$book->title}}" data-category="{{$book->category}}" data-author="{{$book->author}}" data-publisher="{{$book->publisher}}" data-about="{{$book->about}}" data-qty="{{$book->qty}}" data-image="{{asset('uploaded_files/book-cover/'.$book->image)}}">Detail Buku</button>
                                        </div>
                                        <div class="col-6 text-right p-0">
                                            <span class="badge badge-light mr-1 stok">Stok buku : {{$book->qty}}</span>
                                            <span class="badge badge-light mr-3 stok">ID : {{$book->id}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-btn position-relative mr-2">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Data Modal -->
    <div class="modal modal-admin fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <h5>TAMBAH DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form action="{{url('/book')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="judulBuku">Judul Buku</small>
                                <input type="text" class="form-control @error('judulBuku') is-invalid @enderror" id="judulBuku" name="judulBuku" placeholder="Isikan disini...">
                                @error('judulBuku')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-6 pr-1">
                            <div class="form-group">
                                <small for="penerbitBuku">ID Penerbit Buku</small>
                                <input type="number" class="form-control @error('penerbitBuku') is-invalid @enderror" id="penerbitBuku" name="penerbitBuku" placeholder="Isikan disini...">
                                @error('penerbitBuku')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-6 pl-1">
                            <div class="form-group">
                                <small for="kategoriBuku">ID Kategori Buku</small>
                                <input type="number" class="form-control @error('kategoriBuku') is-invalid @enderror" id="kategoriBuku" name="kategoriBuku" placeholder="Isikan disini...">
                                @error('kategoriBuku')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-8 pr-1">
                            <div class="form-group">
                                <small for="penulisBuku">Penulis Buku</small>
                                <input type="text" class="form-control @error('penulisBuku') is-invalid @enderror" id="penulisBuku" name="penulisBuku" placeholder="Isikan disini...">
                                @error('penulisBuku')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-4 pl-1">
                            <div class="form-group">
                                <small for="stokBuku">Stok Buku</small>
                                <input type="number" class="form-control @error('stokBuku') is-invalid @enderror" id="stokBuku" name="stokBuku" placeholder="Isikan disini...">
                                @error('stokBuku')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-8 pr-1">
                            <div class="form-group">
                                <small for="isbnBuku">Kode ISBN (xxx-xxx-xxxx-xx-x)</small>
                                <input type="text" class="form-control @error('isbnBuku') is-invalid @enderror" id="isbnBuku" name="isbnBuku" placeholder="Isikan disini...">
                                @error('isbnBuku')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-4 pl-1">
                            <div class="form-group">
                                <small for="tahunTerbit">Tahun Terbit</small>
                                <input type="number" class="form-control @error('tahunTerbit') is-invalid @enderror" id="tahunTerbit" name="tahunTerbit" placeholder="Isikan disini...">
                                @error('tahunTerbit')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="tentangBuku">Tentang Buku</small>
                                <textarea class="form-control @error('tentangBuku') is-invalid @enderror" id="tentangBuku" name="tentangBuku" placeholder="Isikan disini..." rows="3"></textarea>
                                @error('tentangBuku')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row form-mg">
                          <div class="col-12">
                            <small for="gambarBuku">Gambar Buku</small>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="gambarBuku" name="gambarBuku" onchange="document.getElementById('member-foto').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                  <label class="custom-file-label" for="gambarBuku" id="name-label">Choose file</label>
                                </div>
                            </div>
                            @error('gambarBuku')
                              <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                            @enderror
                          </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                          <div class="col-4 px-0">
                            <div class="preview-img" id="preview-img">
                                <img class="full-width full-height fit-cover-top" id="member-foto">
                            </div>
                          </div>
                          <div class="col-8 text-black pt-3 px-1">
                            <small>Mohon diisi secara lengkap,<br>serta diisi dengan data yang sebenar-benarnya.</small>
                            <button type="submit" class="btn btn-sm btn-primary mt-3 px-5" name="tambahData">Tambah Data</button>
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

    <!-- Edit Data Modal -->
    <div class="modal modal-admin fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <h5>EDIT DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="form-edit"></div>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Data Modal -->
    <div class="modal modal-admin fade" id="detailDataModal" tabindex="-1" aria-labelledby="detailDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{asset('img/icon.png')}}" alt="icon" width="55">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3">
                                <div class="image-buku">

                                </div>
                            </div>
                            <div class="col-9">
                                <div class="detail">
                                    <h1 class="detail-judul"></h1>
                                    <span class="badge badge-secondary detail-kategori mb-2">Kategori</span>
                                    <p class="detail detail-penulis">Ditulis oleh : Ilham Shiddiq</p>
                                    <p class="detail detail-penerbit">Diterbitkan oleh : Ilham Shiddiq Publisher</p>
                                    <p class="detail detail-tentang">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam aspernatur est nisi dolorum vero! Assumenda necessitatibus unde commodi rem labore accusamus cum nobis minima obcaecati vel eos, dignissimos quia possimus.
                                    </p>
                                    <p class="detail detail-stok">Tersedia : <span>89</span> buku</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <small>O'Library &copy; 2020, SMKN 1 Cimahi</small>
                </div>
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
    
    <!-- Export Modal -->
    <div class="modal modal-admin fade" id="exportDataModal" tabindex="-1" aria-labelledby="addDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <h5>EXPORT DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                  <form action="{{url('/book/import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file" onchange="document.getElementById('name-label-import').innerHTML = this.files[0].name">
                          <label class="custom-file-label" for="file" id="name-label-import">File ..</label>
                        </div>
                      </div>
                      @error('file')
                        <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                      @enderror
                      <small for="file">Kolom dalam file harus terdiri atas : kode isbn, judul buku, id penerbit, penulis, id kategori, stok, sinopsis, tahun terbit</small>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-sm btn-success px-5">Submit</button>
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

@section('more-js')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let modal = $(this)

            modal.find('.form-hapus').html(`
                                            <form action="{{url('/book/${id}')}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                            </form>`)
        });
        $('#detailDataModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let title = button.data('title')
            let category = button.data('category')
            let author = button.data('author')
            let publisher = button.data('publisher')
            let about = button.data('about')
            let qty = button.data('qty')
            let image = button.data('image')
            let modal = $(this)

            modal.find('.detail-judul').html(title)
            modal.find('.detail-kategori').html(category)
            modal.find('.detail-penulis').html('Ditulis oleh: '+author)
            modal.find('.detail-penerbit').html('Diterbitkan oleh: '+publisher)
            modal.find('.detail-tentang').html(about)
            modal.find('.detail-stok').html('Tersedia: '+qty+' buku')
            modal.find('.image-buku').html(`<img src="${image}" alt="${title}" class="full-width full-height fit-cover">`)
        });
        $('#editDataModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let isbn = button.data('isbn')
            let title = button.data('title')
            let category = button.data('category_id')
            let author = button.data('author')
            let publisher = button.data('publisher_id')
            let about = button.data('about')
            let terbit = button.data('terbit')
            let qty = button.data('qty')
            let image = button.data('image')
            let nameImg = button.data('nameimg')
            let modal = $(this)

            modal.find('.form-edit').html(`
                                <form action="{{url('/book/${id}')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <small for="judulBuku">Judul Buku</small>
                                                <input type="text" class="form-control @error('judulBuku') is-invalid @enderror" id="judulBuku" name="judulBuku" placeholder="Isikan disini..." value="${title}">
                                                @error('judulBuku')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-mg">
                                        <div class="col-6 pr-1">
                                            <div class="form-group">
                                                <small for="penerbitBuku">ID Penerbit Buku</small>
                                                <input type="number" class="form-control @error('penerbitBuku') is-invalid @enderror" id="penerbitBuku" name="penerbitBuku" placeholder="Isikan disini..." value="${publisher}">
                                                @error('penerbitBuku')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <small for="kategoriBuku">ID Kategori Buku</small>
                                                <input type="number" class="form-control @error('kategoriBuku') is-invalid @enderror" id="kategoriBuku" name="kategoriBuku" placeholder="Isikan disini..." value="${category}">
                                                @error('kategoriBuku')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-mg">
                                        <div class="col-8 pr-1">
                                            <div class="form-group">
                                                <small for="penulisBuku">Penulis Buku</small>
                                                <input type="text" class="form-control @error('penulisBuku') is-invalid @enderror" id="penulisBuku" name="penulisBuku" placeholder="Isikan disini..." value="${author}">
                                                @error('penulisBuku')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <small for="stokBuku">Stok Buku</small>
                                                <input type="number" class="form-control @error('stokBuku') is-invalid @enderror" id="stokBuku" name="stokBuku" placeholder="Isikan disini..." value="${qty}">
                                                @error('stokBuku')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-mg">
                                        <div class="col-8 pr-1">
                                            <div class="form-group">
                                                <small for="isbnBuku">Kode ISBN (xxx-xxx-xxxx-xx-x)</small>
                                                <input type="text" class="form-control @error('isbnBuku') is-invalid @enderror" id="isbnBuku" name="isbnBuku" placeholder="Isikan disini..." value="${isbn}">
                                                @error('isbnBuku')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4 pl-1">
                                            <div class="form-group">
                                                <small for="tahunTerbit">Tahun Terbit</small>
                                                <input type="number" class="form-control @error('tahunTerbit') is-invalid @enderror" id="tahunTerbit" name="tahunTerbit" placeholder="Isikan disini..." value="${terbit}">
                                                @error('tahunTerbit')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-mg">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <small for="tentangBuku">Tentang Buku</small>
                                                <textarea class="form-control @error('tentangBuku') is-invalid @enderror" id="tentangBuku" name="tentangBuku" placeholder="Isikan disini..." rows="3">${about}</textarea>
                                                @error('tentangBuku')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-mg">
                                        <div class="col-12">
                                            <small for="gambarBuku">Gambar Buku</small>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="gambarBuku" name="gambarBuku" onchange="document.getElementById('member-foto-edit').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label-edit').innerHTML = this.files[0].name">
                                                <label class="custom-file-label" for="gambarBuku" id="name-label-edit">${nameImg}</label>
                                                </div>
                                            </div>
                                            @error('gambarBuku')
                                            <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-3">
                                        <div class="col-4 px-0">
                                            <div class="preview-img" id="preview-img">
                                                <img src="${image}" class="full-width full-height fit-cover" id="member-foto-edit">
                                            </div>
                                        </div>
                                        <div class="col-8 text-black pt-3 px-1">
                                            <small>Mohon diisi secara lengkap,<br>serta diisi dengan data yang sebenar-benarnya.</small>
                                            <button type="submit" class="btn btn-sm btn-success mt-3 px-5" name="edithData">Edit Data</button>
                                        </div>
                                    </div>
                                </form>`)
        });
    </script>
@endsection