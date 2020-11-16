@extends('../templates/admin')

@section('title', 'Data Pengajuan')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Admin</li>
        <li class="breadcrumb-item"><a href="{{ url('/permission') }}">Permission</a></li>
    </ol>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-md-4 col-lg-4 p-1">
                <div class="gray-wrapper radius-admin">
                  <div class="info-login-pic text-center border-bottom pb-2">
                      <img src="{{asset('uploaded_files/librarian-foto/'.auth()->user()->profile_photo_path)}}" alt="Ilham Shiddiq" class="rounded-circle fit-cover" width="70" height="70">
                  </div>
                  <div class="info-login text-center pt-1">
                      <p class="m-1">Halo, {{auth()->user()->username}} ({{auth()->user()->name}})</p>
                      <span class="badge badge-success">{{auth()->user()->role}}</span>
                  </div>
                </div>
            </div>
            <div class="col-11 col-md-4 col-lg-4 p-1">
                <div class="warning-wrapper pengajuan-wrapper radius-admin">
                  <div class="info-login-pic text-center border-bottom pb-2">
                      <div class="total">23</div>
                  </div>
                  <div class="info-login text-center pt-1">
                      <p class="m-1">Jumlah daftar kadaluarsa</p>
                      <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteExpired">Delete Data</a>
                  </div>
                </div>
            </div>
            <div class="col-11 col-md-4 col-lg-4 p-1">
                <div class="danger-wrapper pengajuan-wrapper radius-admin">
                  <div class="info-login-pic text-center border-bottom pb-2">
                    <div class="total">51</div>
                  </div>
                  <div class="info-login text-center pt-1">
                      <p class="m-1">Jumlah daftar ditolak</p>
                      <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteRefused">Delete Data</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1 class="title-pagination text-center mt-3">Data Kategori</h1>
                <div class="total-row text-center mb-3">
                    Data Ditampilkan
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" style="width: 1100px">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" style="width: 90px" class="text-center">ID Mem.</th>
                            <th scope="col" style="width: 330px" class="text-center">Judul Ebook</th>
                            <th scope="col" style="width: 330px" class="text-center">Alasan</th>
                            <th scope="col" style="width: 90px" class="text-center">Status</th>
                            <th scope="col" style="width: 120px" class="text-center">Action</th>
                            <th scope="col">Batas Tgl.</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td> officiis nisi quam, quae, iure reiciendis sit, rem maxime at ducimus</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur</td>
                                <td class="text-center"><span class="badge badge-success px-2 py-2 rounded-circle"> </span></td>
                                <td class="text-center">-</td>
                                <td>2020-03-20</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td> officiis nisi quam, quae, iure reiciendis sit, rem maxime at ducimus</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur corrupti similique</td>
                                <td class="text-center"><span class="badge badge-danger px-2 py-2 rounded-circle"> </span></td>
                                <td class="text-center">-</td>
                                <td>2020-03-20</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td> officiis nisi quam, quae, iure reiciendis sit, rem maxime at ducimus</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur corrupti similique</td>
                                <td class="text-center">-</td>
                                <td class="text-center"><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptModal"><i class="fas fa-check"></i></button> <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#refuseModal"><i class="fas fa-times"></i></button></td>
                                <td>2020-03-20</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td> officiis nisi quam, quae, iure reiciendis sit, rem maxime at ducimus</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur corrupti similique</td>
                                <td class="text-center">-</td>
                                <td class="text-center"><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptModal"><i class="fas fa-check"></i></button> <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#refuseModal"><i class="fas fa-times"></i></button></td>
                                <td>2020-03-20</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td> officiis nisi quam, quae, iure reiciendis sit, rem maxime at ducimus</td>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur corrupti similique</td>
                                <td class="text-center">-</td>
                                <td class="text-center"><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptModal"><i class="fas fa-check"></i></button> <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#refuseModal"><i class="fas fa-times"></i></button></td>
                                <td>2020-03-20</td>
                            </tr>
                          {{-- @foreach ($categories as $category)  
                          <tr>
                            <th scope="row" class="text-center">{{$category->id}}</th>
                            <td>{{$category->category}}</td>
                            <td>
                              <a href="#" class="badge badge-success" data-toggle="modal" data-target="#editDataModal" data-id="{{$category->id}}" data-category="{{$category->category}}">Edit</a>
                              <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{$category->id}}">Hapus</a>
                            </td>
                          </tr>
                          @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <div class="pagination-btn position-relative mr-2">
                  {{-- {{ $categories->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    
    <!-- Accept Modal -->
    <div class="modal modal-admin fade" id="acceptModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title py-2" id="exampleModalLabel">PLEASE CONFIRM..</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-3 text-center">
                    <h5>Terima pengajuan ini?</h5>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-success">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Refuse Modal -->
    <div class="modal modal-admin fade" id="refuseModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title py-2" id="exampleModalLabel">PLEASE CONFIRM..</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-3 text-center">
                    <h5>Tolak pengajuan ini?</h5>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Expired Data Modal -->
    <div class="modal modal-admin fade" id="deleteExpired" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title py-2" id="exampleModalLabel">PLEASE CONFIRM..</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-3 text-center">
                    <h6>Yakin hapus semua data yang kadaluarsa?</h6>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Refused Data Modal -->
    <div class="modal modal-admin fade" id="deleteRefused" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title py-2" id="exampleModalLabel">PLEASE CONFIRM..</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-3 text-center">
                    <h6>Yakin hapus semua data yang ditolak?</h6>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger">Yes</a>
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
                                        <form action="{{url('/category/${id}')}}" method="POST">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-danger">Yes</button>
                                        </form>`)
                                      });

      $('#editDataModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget) // Button that triggered the modal
        let id = button.data('id')
        let category = button.data('category')
        let modal = $(this)

        modal.find('.form-edit').html(`
                                        <form action="{{url('/category/${id}')}}" method="POST">
                                          @method('put')
                                          @csrf
                                          <div class="row">
                                            <div class="col-9 pl-4 pr-1">
                                              <div class="form-group">
                                                  <small for="kategoriBuku">Kategori Buku</small>
                                                  <input type="text" class="form-control" id="kategoriBuku" name="kategoriBuku" placeholder="Isikan disini..." value="${category}">
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