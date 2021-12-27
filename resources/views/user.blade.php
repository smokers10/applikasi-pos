@extends('layouts.main')

@push('style')
<style>
    .dataTables_filter {
        float: right;
        /* text-align: right; */
    }

    .pagination{
        float: right;
        text-align: right;
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengguna</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Akun Kasir</h3>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary btn-sm" data-type="create" onclick="openCRUDModal(this)">Tambah Akun Baru</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kontak</th>
                                    <th>Alamat</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->contact}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>
                                            <button class="btn btn-success" data-type="edit" detail='{{$user}}' onclick="openCRUDModal(this)"><i class="fas fa-edit"></i></button>
                                            <!-- <button class="btn btn-danger" data-type="delete" onclick="openCRUDModal(this)"><i class="fas fa-trash"></i></button> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kontak</th>
                                    <th>Alamat</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<div class="modal fade" id="modal-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="user-form">
                <input type="hidden" name="type" id="type">
                <input type="hidden" name="id" id="id">

                <div id="createupdate">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama">
                        </div>

                        <div class="form-group">
                            <label for="contact">Kontak</label>
                            <input type="text" class="form-control" id="contact" name="contact" placeholder="Masukan kontak">
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Masukan alamat">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email">
                        </div>

                        <div class="form-group" id="password-inpt">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan alamat">
                        </div>
                    </div>
                </div>

                <div id="deleting">
                    <div class="modal-body">
                        <center>
                            <h1>Apakah Anda Yakin?</h1>
                            <p>Data Yang Dihapus Tidak Dapat Dikembalikan</p>
                        </center>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">batal</button>
                    <button type="submit" class="btn btn-primary">Oke</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-swal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Notifikasi Sistem</h4>
            </div>

            <div class="modal-body">
                <center>
                    <h1 id="swal-title">Mohon Tunggu</h1>
                    <p id="swal-content"></p>
                </center>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });

        $("#user-form").submit(function(e){
            e.preventDefault()
            submit()
        })
    })

    function openCRUDModal(el) {
        var type = $(el).attr("data-type")
        $("#type").val(type)
        $('#modal-user').modal('show')

        if(type == "edit"){
            $("#deleting").hide()
            $("#createupdate").show()
            var data = JSON.parse($(el).attr("detail"))
            $("#id").val(data.id)
            $("#email").val(data.email)
            $("#contact").val(data.contact)
            $("#name").val(data.name)
            $("#address").val(data.address)
            $("#email").prop("disabled", true)
            $("#password-inpt").hide()
            $("#modal-title").text("Edit Data Pengguna")
            return
        }

        if (type == "create") {
            $("#deleting").hide()
            $("#createupdate").show()
            $("#user-form").trigger('reset')
            $("#modal-title").text("Tambah Pengguna Baru")
            $("#email").prop("disabled", false)
            $("#password-inpt").show()
            return
        }

        if (type == "delete") {
            $("#deleting").show()
            $("#createupdate").hide()
            $("#modal-title").text("Hapus Data Pengguna")
            return
        }
    }

    function submit() {
        var formData = new FormData($('#user-form')[0]);
        var type = $("#type").val()
        if (type == "edit") update(formData)
        if (type == "create") create(formData)
    }

    function update(data) {
        $.ajax({
            url:"{{ route('user.update') }}",
            type:"post",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#modal-user').modal('hide')
                $("#modal-swal").modal('show')
                $("#swal-title").text("Mohon Tunggu")
                $("#swal-content").text('Sedang Update User')
            },
            success: function(res){
                $("#swal-title").text("Update selesai")
                $("#swal-content").text('Sedang Update User')
                setTimeout(final(), 3000)
            }
        })
    }

    function create(data) {
        $.ajax({
            url:"{{ route('user.create') }}",
            type:"post",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#modal-user').modal('hide')
                $("#modal-swal").modal('show')
                $("#swal-title").text("Mohon Tunggu")
                $("#swal-content").text('Sedang Membuat User Baru')
            },
            success: function(res){
                $("#swal-title").text("Pembuatan selesai")
                $("#swal-content").text('')
                setTimeout(final(), 3000)
            }
        })
    }

    function final() {
        $("#modal-swal").modal('hide')
        location.reload()
    }
</script>
@endpush