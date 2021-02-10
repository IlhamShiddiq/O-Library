@extends('../templates/admin')

@section('title', 'Data Penerbit')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/publisher') }}">Publisher</a></li>
    </ol>
@endsection

@section('content')
    @error('penerbitBuku')
      <div class="message message-danger message-admin position-absolute shadow">
          <div class="message-header position-relative text-white rounded-top">
              <h6>Message!!</h6>
              <button class="btn position-absolute text-white" id="btn-close-message"><i class="fas fa-times"></i></button>
              <div class="triangle-up position-absolute"></div>
          </div>
          <div class="message-body">
              Form tidak boleh kosong
          </div>
      </div>
    @enderror

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
                    <form action="{{url('/publisher/search')}}" method="post">
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
                    <a href="{{ url('/publisher') }}" class="btn btn-success full-width"><i class="fas fa-eye"></i> See All</a>
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
                <h1 class="title-pagination text-center mb-3">Data Penerbit</h1>
                <table class="table table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col" style="width: 55px" class="text-center">ID</th>
                      <th scope="col">Publisher</th>
                      <th style="width: 140px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($publishers as $publisher)
                      <tr>
                        <th scope="row" class="text-center">{{$publisher->id}}</th>
                        <td>{{$publisher->publisher}}</td>
                        <td>
                          <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataModal" data-id="{{$publisher->id}}" data-publisher="{{$publisher->publisher}}"><i class="fas fa-edit"></i></a>
                          <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$publisher->id}}"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="pagination-btn position-relative mb-3 mr-2">
                  {{ $publishers->links() }}
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
                  <form action="{{url('/publisher')}}" method="post">
                    @csrf
                    <div class="row">
                      <div class="col-7 pl-4 pr-1">
                        <div class="form-group">
                            <small for="penerbitBuku">Penerbit Buku</small>
                            <input type="text" class="form-control @error('penerbitBuku') is-invalid @enderror" id="penerbitBuku" name="penerbitBuku" placeholder="Isikan disini...">
                            @error('penerbitBuku')
                              <div id="validationServer03Feedback" class="invalid-feedback">
                                {{$message}}
                              </div>
                            @enderror
                        </div>
                      </div>
                      <div class="col-5 pl-1 pr-4">
                        <button type="submit" class="btn btn-primary mt-4 full-width" name="tambahData">Tambah Data</button>
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
                  <form action="{{url('/publisher/import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file" onchange="document.getElementById('name-label').innerHTML = this.files[0].name">
                          <label class="custom-file-label" for="file" id="name-label">File ..</label>
                        </div>
                      </div>
                      <small for="file">Kolom dalam file harus terdiri atas : id, nama penerbit</small>
                      @error('file')
                        <div id="validationServer03Feedback" class="invalid-feedback">
                          {{$message}}
                        </div>
                      @enderror
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
@endsection

@section('more-js')
    <script>
      $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let id = button.data('id')
        let modal = $(this)

        modal.find('.form-hapus').html(`
                                        <form action="{{url('/publisher/${id}')}}" method="POST">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-danger">Yes</button>
                                        </form>`)
                                      });

      $('#editDataModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let id = button.data('id')
        let publisher = button.data('publisher')
        let modal = $(this)

        modal.find('.form-edit').html(`
                                        <form action="{{url('/publisher/${id}')}}" method="POST">
                                          @method('put')
                                          @csrf
                                          <div class="row">
                                            <div class="col-9 pl-4 pr-1">
                                              <div class="form-group">
                                                  <small for="penerbitBuku">Kategori Buku</small>
                                                  <input type="text" class="form-control" id="penerbitBuku" name="penerbitBuku" placeholder="Isikan disini..." value="${publisher}">
                                              </div>
                                            </div>
                                            <div class="col-3 pl-1 pr-4">
                                              <button type="submit" class="btn btn-success mt-4 full-width" name="editData">Edit Data</button>
                                            </div>
                                          </div>
                                        </form>`)
                                      });
    </script>
@endsection