@extends('../templates/admin')

@section('title', 'Data Ebook')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/ebook') }}">Ebook</a></li>
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
                    <form action="{{url('/ebook/search')}}" method="post">
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
                    <a href="{{ url('/ebook') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
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
                <h1 class="title-pagination text-center mb-3">Data Ebook</h1>
                <div class="list-item">
                    @foreach ($ebooks as $ebook)
                        <div class="item-table item-buku shadow">
                            <div class="item-table-header top-absolute">
                                <h1 class="judul text-white">{{$ebook->title}}</h1>
                            </div>
                            <div class="item-table-body">
                                <div class="row">
                                    <div class="col-6 col-md-8 col-lg-8">
                                        <span class="badge badge-secondary">{{$ebook->category}}</span>
                                        <p class="about mt-2">
                                            {{$ebook->about}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="image-buku">
                                <div class="image">
                                    <img src="{{asset('/uploaded_files/ebook-cover/'.$ebook->image)}}" alt="{{$ebook->title}}" class="full-width full-height fit-cover-top">
                                </div>
                            </div>
                            <div class="btn-action bottom-absolute">
                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataModal" data-id="{{$ebook->id}}" data-isbn="{{$ebook->isbn}}" data-title="{{$ebook->title}}" data-category_id="{{$ebook->category_id}}" data-author="{{$ebook->author}}" data-publisher_id="{{$ebook->publisher_id}}" data-about="{{$ebook->about}}" data-terbit="{{$ebook->publish_year}}" data-link="{{$ebook->link}}" data-image="{{asset('uploaded_files/ebook-cover/'.$ebook->image)}}" data-nameimg="{{$ebook->image}}">Ubah</a>
                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$ebook->id}}">Hapus</a>
                                <a href="{{$ebook->link}}" class="btn btn-sm btn-info text-white" target="_blank" rel=”noopener”>Buka ebook</a>
                            </div>
                            <div class="item-table-footer bottom-absolute">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6 p-0">
                                            <a href="{{url('/ebook/detail/'.$ebook->id)}}" class="btn btn-dark px-5 rounded-0">Detail Ebook</a>
                                        </div>
                                        <div class="col-6 text-right p-0">
                                            <span class="badge badge-light mr-3 stok">ID : {{$ebook->id}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Add Data Modal -->
    <div class="modal modal-admin fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="img/icon.png" alt="icon" width="55">
                    <h5>TAMBAH DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <form action="{{url('/ebook')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                                <small for="judulEbook">Judul Ebook</small>
                                <input type="text" class="form-control @error('judulEbook') is-invalid @enderror" id="judulEbook" name="judulEbook" placeholder="Isikan disini...">
                                @error('judulEbook')
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
                                  <small for="penerbitEbook">ID Penerbit Ebook</small>
                                  <input type="number" class="form-control @error('penerbitEbook') is-invalid @enderror" id="penerbitEbook" name="penerbitEbook" placeholder="Isikan disini...">
                                  @error('penerbitEbook')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                  @enderror
                              </div>
                            </div>
                            <div class="col-6 pl-1">
                              <div class="form-group">
                                  <small for="kategoriEbook">ID Kategori Ebook</small>
                                  <input type="number" class="form-control @error('kategoriEbook') is-invalid @enderror" id="kategoriEbook" name="kategoriEbook" placeholder="Isikan disini...">
                                  @error('kategoriEbook')
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
                                <small for="penulisEbook">Penulis Ebook</small>
                                <input type="text" class="form-control @error('penulisEbook') is-invalid @enderror" id="penulisEbook" name="penulisEbook" placeholder="Isikan disini...">
                                @error('penulisEbook')
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
                                <small for="isbnEbook">Kode ISBN Ebook (xxx-xxx-xxxx-xx-x)</small>
                                <input type="text" class="form-control @error('isbnEbook') is-invalid @enderror" id="isbnEbook" name="isbnEbook" placeholder="Isikan disini...">
                                @error('isbnEbook')
                                  <div id="validationServer03Feedback" class="invalid-feedback">
                                    {{$message}}
                                  </div>
                                @enderror
                            </div>
                          </div>
                          <div class="col-6 pl-1">
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
                                <small for="tentangEbook">Tentang Ebook</small>
                                <textarea class="form-control @error('tentangEbook') is-invalid @enderror" id="tentangEbook" name="tentangEbook" placeholder="Isikan disini..." rows="3"></textarea>
                                @error('tentangEbook')
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
                                    <small for="fileEbook">Link Drive File Ebook</small>
                                    <p class="xlsm-font">Pastikan link anda sudah diberi izin akses untuk semua user</p>
                                    <input type="text" class="form-control @error('fileEbook') is-invalid @enderror" id="fileEbook" name="fileEbook" placeholder="Isikan disini..." autocomplete="off">
                                    @error('fileEbook')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                      {{$message}}
                                    </div>
                                @enderror
                                </div>
                              </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <small for="gambarEbook">Gambar Ebook</small>
                            <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input @error('gambarEbook') is-invalid @enderror" id="gambarEbook" name="gambarEbook" onchange="document.getElementById('member-foto').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label').innerHTML = this.files[0].name">
                                  <label class="custom-file-label" for="gambarEbook" id="name-label">Choose file</label>
                                </div>
                            </div>
                            @error('gambarEbook')
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
                    <img src="img/icon.png" alt="icon" width="55">
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
                <form action="{{url('/ebook/import')}}" method="post" enctype="multipart/form-data">
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
                    <small for="file">Kolom dalam file harus terdiri atas : kode isbn, judul buku, id penerbit, penulis, id kategori, link, sinopsis, tahun terbit</small>
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
                                            <form action="{{url('/ebook/${id}')}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                            </form>`)
        });
        $('#editDataModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let title = button.data('title')
            let category = button.data('category_id')
            let author = button.data('author')
            let publisher = button.data('publisher_id')
            let about = button.data('about')
            let isbn = button.data('isbn')
            let terbit = button.data('terbit')
            let link = button.data('link')
            let image = button.data('image')
            let nameImg = button.data('nameimg')
            let modal = $(this)

            modal.find('.form-edit').html(`
                                  <form action="{{url('/ebook/${id}')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                      <div class="col-12">
                                        <div class="form-group">
                                            <small for="judulEbook">Judul Ebook</small>
                                            <input type="text" class="form-control @error('judulEbook') is-invalid @enderror" id="judulEbook" name="judulEbook" placeholder="Isikan disini..." value="${title}">
                                            @error('judulEbook')
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
                                              <small for="penerbitEbook">ID Penerbit Ebook</small>
                                              <input type="number" class="form-control @error('penerbitEbook') is-invalid @enderror" id="penerbitEbook" name="penerbitEbook" placeholder="Isikan disini..." value="${publisher}">
                                              @error('penerbitEbook')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                  {{$message}}
                                                </div>
                                              @enderror
                                          </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                          <div class="form-group">
                                              <small for="kategoriEbook">ID Kategori Ebook</small>
                                              <input type="number" class="form-control @error('kategoriEbook') is-invalid @enderror" id="kategoriEbook" name="kategoriEbook" placeholder="Isikan disini..." value="${category}">
                                              @error('kategoriEbook')
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
                                            <small for="penulisEbook">Penulis Ebook</small>
                                            <input type="text" class="form-control @error('penulisEbook') is-invalid @enderror" id="penulisEbook" name="penulisEbook" placeholder="Isikan disini..." value="${author}">
                                            @error('penulisEbook')
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
                                            <small for="isbnEbook">Kode ISBN Ebook (xxx-xxx-xxxx-xx-x)</small>
                                            <input type="text" class="form-control @error('isbnEbook') is-invalid @enderror" id="isbnEbook" name="isbnEbook" placeholder="Isikan disini..." value="${isbn}">
                                            @error('isbnEbook')
                                              <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{$message}}
                                              </div>
                                            @enderror
                                        </div>
                                      </div>
                                      <div class="col-6 pl-1">
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
                                            <small for="tentangEbook">Tentang Ebook</small>
                                            <textarea class="form-control @error('tentangEbook') is-invalid @enderror" id="tentangEbook" name="tentangEbook" placeholder="Isikan disini..." rows="3">${about}</textarea>
                                            @error('tentangEbook')
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
                                                <small for="fileEbook">Link Drive File Ebook</small>
                                                <p class="xlsm-font">Pastikan link anda sudah diberi izin akses untuk semua user</p>
                                                <input type="text" class="form-control @error('fileEbook') is-invalid @enderror" id="fileEbook" name="fileEbook" placeholder="Isikan disini..." autocomplete="off" value="${link}">
                                                @error('fileEbook')
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                      {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-12">
                                        <small for="gambarEbook">Gambar Ebook</small>
                                        <div class="input-group">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input @error('gambarEbook') is-invalid @enderror" id="gambarEbook" name="gambarEbook" onchange="document.getElementById('member-foto-edit').src = window.URL.createObjectURL(this.files[0]), document.getElementById('name-label-edit').innerHTML = this.files[0].name">
                                              <label class="custom-file-label" for="gambarEbook" id="name-label-edit">${nameImg}</label>
                                            </div>
                                        </div>
                                        @error('gambarEbook')
                                            <p style="font-size: 80%; color: #dc3545; margin-top: .25rem">{{$message}}</p>
                                        @enderror
                                      </div>
                                    </div>
                                    <div class="row justify-content-center mt-3">
                                      <div class="col-4 px-0">
                                        <div class="preview-img" id="preview-img">
                                            <img src="${image}" class="full-width full-height fit-cover-top" id="member-foto-edit">
                                        </div>
                                      </div>
                                      <div class="col-8 text-black pt-3 px-1">
                                        <small>Mohon diisi secara lengkap,<br>serta diisi dengan data yang sebenar-benarnya.</small>
                                        <button type="submit" class="btn btn-sm btn-success mt-3 px-5" name="ubahData">Ubah Data</button>
                                      </div>
                                    </div>
                                  </form>`)
        });
    </script>
@endsection