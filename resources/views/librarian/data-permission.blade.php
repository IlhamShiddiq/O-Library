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
                      <div class="total">{{$expired}}</div>
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
                    <div class="total">{{$refused}}</div>
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
                <h1 class="title-pagination text-center mt-3">Data Pengajuan</h1>
                <div class="total-row text-center mb-3">
                    {{$count}} data ditampilkan, {{$requested}} daftar menungu dikonfirmasi
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" style="width: 1100px">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col" style="width: 90px" class="text-center">NIS/NIP</th>
                            <th scope="col" style="width: 330px" class="text-center">Judul Ebook</th>
                            <th scope="col" style="width: 330px" class="text-center">Alasan</th>
                            <th scope="col" style="width: 90px" class="text-center">Status</th>
                            <th scope="col" style="width: 120px" class="text-center">Action</th>
                            <th scope="col">Batas Tgl.</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="text-center">{{$permission->nomor_induk}}</td>
                                    <td>{{$permission->title}}</td>
                                    <td>{{$permission->reason}}</td>
                                    @if ($permission->confirmed == '1')
                                        @if ($permission->accepted == '1')
                                            <td class="text-center"><span class="badge badge-success px-2 py-2 rounded-circle"> </span></td>
                                            <td class="text-center">-</td>
                                            <td @if($permission->limit_date < date('Y-m-d')) style="color: red; font-style: italic" @endif class="text-center">{{$permission->limit_date}}</td>
                                        @else
                                            <td class="text-center"><span class="badge badge-danger px-2 py-2 rounded-circle"> </span></td>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                        @endif
                                    @else 
                                        <td class="text-center"><span class="badge badge-warning px-2 py-2 rounded-circle"> </span></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#acceptModal" data-id='{{$permission->id}}'><i class="fas fa-check"></i></button>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#refuseModal" data-id='{{$permission->id}}'><i class="fas fa-times"></i></button>
                                        </td>
                                        <td class="text-center">-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-btn position-relative mb-3 mr-2">
                        {{ $permissions->links() }}
                    </div>
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
                    <button type="button" class="btn btn-secondary d-inline-block" data-dismiss="modal">Cancel</button>
                    <form action="{{url('/permission/accept')}}" method="post" class="d-inline-block">
                        @csrf
                        <div class="form-hidden"></div>
                        <button type="submit" class="btn btn-success d-inline-block">Yes</button>
                    </form>
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
                <div class="modal-body py-2 py-3">
                    <h5 class="text-center">Tolak pengajuan ini?</h5>
                    <form action="{{url('/permission/refuse')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <small>Alasan penolakan</small>
                            <textarea class="form-control" id="alasan" name="alasan" placeholder="Isikan disini..." rows="3"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-danger px-5">No</button>
                        </div>
                        <div class="form-hidden"></div>
                    </form>
                </div>
                <div class="modal-footer text-center">

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
                    <a href="{{url('/permission/delete/expired')}}" class="btn btn-danger">Yes</a>
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
                    <a href="{{url('/permission/delete/refused')}}" class="btn btn-danger">Yes</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('more-js')
    <script>
        $('#acceptModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let modal = $(this)

            modal.find('.form-hidden').html(`
                                            <input type="hidden" name="id" value="${id}">
                                        `)
        });
        $('#refuseModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget) // Button that triggered the modal
            let id = button.data('id')
            let modal = $(this)

            modal.find('.form-hidden').html(`
                                            <input type="hidden" name="id" value="${id}">
                                        `)
        });
    </script>
@endsection