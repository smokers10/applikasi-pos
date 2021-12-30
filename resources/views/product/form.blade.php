@extends('layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Produk</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/product">Produk</a></li>
                    <li class="breadcrumb-item active">Tambah Produk</li>
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
                        <h3 class="card-title">Input Produk</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="#" method="post" id="form-product">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama produk" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Kode Produk</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Masukan kode produk" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Stok Produk</label>
                                <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukan stok produk" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Satuan Stok</label>
                                <select class="form-control" name="stok_unit_id" id="stok_unit_id" required>
                                    <option value="">Pilih satuan stok</option>
                                    @foreach ($stock_units as $stock_unit)
                                    <option value="{{$stock_unit->id}}">{{ $stock_unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Harga Beli Produk</label>
                                <input type="number" class="form-control" id="purchase_price" name="purchase_price" min="1" placeholder="Masukan harga beli produk" required>
                            </div>

                            <div class="form-group">
                                <label for="name">Harga Jual Produk</label>
                                <input type="number" class="form-control" id="selling_price" name="selling_price" min="1" placeholder="Masukan harga jual produk" required>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Kategori Produk</label>
                                <select class="form-control" name="category_id" id="category_id" required>
                                    <option value="">Pilih kategori produk</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

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

            <div id="notif-foot" class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclilck="resetForm()">Tambah Lagi</button>
                <a class="btn btn-primary" href="{{ route('product') }}">Selesai Menambahkan</a>
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
        $("#form-product").submit(function(e){
            e.preventDefault()
            submit()
        })
    })

    function submit() {
        var formData = new FormData($('#form-product')[0]);
        ajaxReq(formData)
    }

    function ajaxReq(data) {
        $.ajax({
            url:"{{ route('product.create') }}",
            type:"post",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $("#modal-swal").modal("show")
                $("#swal-title").text("Mohon Tunggu")
                $("#swal-content").text('Sedang Menambah Produk Baru')
                $("notif-foot").hide()
            },
            success: function(res){
                systemNotification(res)
            }
        })
    }

    function systemNotification(res) {
        if (!res.fail) {
            $("#swal-title").text("Penambahan selesai")
            $("#swal-content").text('Apakah Masih Ingin Tambah Barang')
            $("notif-foot").show()
            return
        }else {
            $("#swal-title").text("Whoops! terjadi kesalahan")
            if (res.errors) {
                $("#swal-content").html("")
                res.errors.code.forEach(el => {
                    $("#swal-content").append(`${el}<br>`)
                })
            } 
            if (!res.errors) {
                $("#swal-content").text('Hubungi Kami Jika Masalah Ini Berlanjut')
            }
            $("notif-foot").show()
            return
        }
    }

    function resetForm(){
        $("#form-product").trigger("reset")
    }
</script>
@endpush