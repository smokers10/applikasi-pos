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
                <h1 class="m-0">Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Produk</li>
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
                        <h3 class="card-title">Data Produk</h3>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary btn-sm" href="{{ route('product.create.page') }}">Tambah Produk Baru</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-product" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Jumlah Penjualan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->stok }} {{ $product->stok_unit->name }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    <td>{{ $product->selling_points }}</td>
                                    <td>
                                        <a class="btn btn-success" data-type="edit" href="{{ route('product.edit.page', $product->id) }}"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-warning" data-type="edit" href="{{ route('product.edit.page', $product->id) }}"><i class="fas fa-eye white"></i></a>
                                        <button class="btn btn-danger" data-type="delete" detail='{{$product}}' onclick="openCRUDModal(this)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kode</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Jumlah Penjualan</th>
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
        $('#table-product').DataTable({
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

        if (type == "delete") {
            var data = JSON.parse($(el).attr("detail"))
            $("#id").val(data.id)
            $("#deleting").show()
            $("#createupdate").hide()
            $("#modal-title").text("Hapus Data Produk")
            return
        }
    }

    function submit() {
        var formData = new FormData($('#user-form')[0]);
        var type = $("#type").val()
        if (type == "edit") update(formData)
        if (type == "create") create(formData)
        if (type == "delete") deleteItem(formData)
    }

    function deleteItem(data) {
        $.ajax({
            url:"{{ route('product.delete') }}",
            type:"post",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#modal-user').modal('hide')
                $("#modal-swal").modal('show')
                $("#swal-title").text("Mohon Tunggu")
                $("#swal-content").text('Sedang Menghapus Produk')
            },
            success: function(res){
                $("#swal-title").text("Penghapusan selesai")
                $("#swal-content").text('')
                setTimeout(final(), 4000)
            }
        })
    }

    function final() {
        $("#modal-swal").modal('hide')
        location.reload()
    }
</script>
@endpush