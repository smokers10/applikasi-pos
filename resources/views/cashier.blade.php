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
                <h1 class="m-0">Kasir</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Kasir</li>
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
                        <h3 class="card-title">Beli Barang</h3>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" data-type="create" onclick="chooseProduct()">Tambah Barang</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="cart-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th class="col-2">Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cart-item">
                            
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-lg-8">
                                <h3>Detail Pembeli</h3>
                                <div class="form-group">
                                    <label for="total">Nama Pembeli</label>
                                    <input type="text" name="buyer_name" id="buyer_name" class="form-control" placeholder="Masukan nama pelanggan">
                                </div>

                                <div class="form-group">
                                    <label for="total">Alamat Pembeli</label>
                                    <input type="text" name="buyer_address" id="buyer_address" class="form-control" placeholder="Masukan alamat pelanggan">
                                </div>

                                <div class="form-group">
                                    <label for="total">Kontak Pembeli</label>
                                    <input type="text" name="buyer_contact" id="buyer_contact" class="form-control" placeholder="Masukan kontak pelanggan">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <h3>Rincian Belanja</h3>
                                <div class="form-group">
                                    <label for="total">PPN</label>
                                    <input type="text" name="ppn_display" id="ppn_display" disabled="disabled" class="form-control" value="0">
                                    <input type="hidden" name="ppn" id="ppn" disabled="disabled" class="form-control" value="0">
                                </div>

                                <div class="form-group">
                                    <label for="total">Subtotal</label>
                                    <input type="text" name="subtotal_display" id="subtotal_display" disabled="disabled" class="form-control" value="0">
                                    <input type="hidden" name="subtotal" id="subtotal" disabled="disabled" class="form-control" value="0">
                                </div>

                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="text" name="payment_total_display" id="payment_total_display" disabled="disabled" class="form-control" value="0">
                                    <input type="hidden" name="payment_total" id="payment_total" disabled="disabled" class="form-control" value="0">
                                </div>

                                <div class="form-group">
                                    <label for="total">Bayar*</label>
                                    <input type="number" name="payment" id="payment" class="form-control" required>
                                    <div id="payment-feedback" class="invalid-feedback d-none"></div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="total">Kembalian</label>
                                    <input type="text" name="return_display" id="return_display" disabled="disabled" class="form-control">
                                    <input type="hidden" name="return" id="return" disabled="disabled" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="payment_method">Metode Pembayaran</label>
                                    <select class="form-control" name="payment_method" id="payment_method">
                                        <option value="Tunai">Tunai</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Kartu Kredit">Kartu Kredit</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit" onclick="preview()">OKE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<!-- pilih barang -->
<div class="modal fade" id="modal-product">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Pilih Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table id="table-product" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->stok }} {{ $product->stok_unit->name }}</td>
                                <td>
                                    <button class="btn btn-primary" detail='{{ $product }}' onclick="addToCart(this)">Tambahkan Ke Keranjang</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end pilih barang -->

<div class="modal fade" id="modal-preview">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Review Pembelian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Amanda Brownies
                                <small class="float-right">Date: {{ date("Y-m-d") }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>Amanda Brownies</strong><br>
                                NPWP : 01.709.021.8-420002<br>
                                Alamat : Jl.Cikawao No.01-03 Bandung<br>
                                Telp : (022) 423 0531<br>
                            </address>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th class="col-2">Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="preview-product">

                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6">
                            <p class="lead">Rincian Belanja</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td id="subtotal-preview"></td>
                                    </tr>
                                    <tr>
                                        <th>PPN (10%):</th>
                                        <td id="ppn-preview"></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td id="total-preview"></td>
                                    </tr>
                                    <tr>
                                        <th>Bayar:</th>
                                        <td id="payment-preview"></td>
                                    </tr>
                                    <tr>
                                        <th>Kembali:</th>
                                        <td id="return-preview"></td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran:</th>
                                        <td id="payment-method-preview"></td>
                                    </tr>
                                    <tr>
                                        <th>Items:</th>
                                        <td id="total_qty"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-right" onclick="submitPayment()">
                                <i class="far fa-credit-card"></i> Submit Pembayaran
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div>
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

            <div id="notif-foot" class="modal-footer justify-content-between">
                <div></div>
                <div>
                    <a class="btn btn-primary" href="#" onclick="resetForm()">Buat Transaksi Lagi</a>
                </div>
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
    <script>
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        })

        $('#table-product').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
        })

        $("#payment").change(function(e){
            var total = parseInt($("#payment_total").val())
            var pay = parseInt($(this).val())
            var returnMoney = pay - total
            $("#return").val(returnMoney)
            $("#return_display").val(formatter.format(returnMoney))
        })

        function chooseProduct(){
            $("#modal-product").modal("show")
        }

        function addToCart(el){
            var detail = JSON.parse($(el).attr("detail"))
            $("#cart-item").append(cartItemElement(detail))
            calculateTotal()
        }

        function cartItemElement(data) {
            return `
                <tr id="item-${data.id}">
                    <td>${data.name}</td>
                    <td>${formatter.format(data.selling_price)}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm-2">
                                <button class="btn btn-secondary btn-sm" detail='${JSON.stringify(data)}' data-type="min" onclick="changeQty(this)"> <i class="fas fa-minus"></i> </button>
                            </div>

                            <div class="col-sm-5">
                                <input id="subtotal-${data.id}" type="hidden" name="subtotal-per-item" value="${data.selling_price}"/>
                                <input id="qty-${data.id}" type="number" name="quantity-per-item" class="form-control form-control-sm" value="1" min="${data.stok}" max="${data.stok}" disabled="disabled"/>
                                <input id="item-${data.id}" type="hidden" name="item" value='${JSON.stringify(data)}'/>
                            </div>

                            <div class="col-sm-3">
                                <input class="form-control form-control-sm" disabled="disabled" value="${data.stok_unit.name}"/>
                            </div>

                            <div class="col-sm-2">
                                <button class="btn btn-secondary btn-sm" detail='${JSON.stringify(data)}' data-type="plus" onclick="changeQty(this)"> <i class="fas fa-plus"></i> </button>
                            </div>
                        </div>
                    </td>
                    <td id="display-subtotal-${data.id}">${formatter.format(data.selling_price)}</td>
                    <td>
                        <button class="btn btn-danger" detail='${JSON.stringify(data)}' data-type="delete" onclick="removeFromCart(this)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `
        }

        function removeFromCart(el) {
            var detail = JSON.parse($(el).attr("detail"))
            var subtotal = parseInt($("#subtotal").val())
            var qty = parseInt($(`#qty-${detail.id}`).val())
            var newTot = subtotal - (detail.selling_price * qty)
            $("#subtotal").val(newTot)
            $("#subtotal_display").val(formatter.format(newTot))
            $(`#item-${detail.id}`).remove()
            calculateTotal()
        }

        function changeQty(el) {
            var detail = JSON.parse($(el).attr("detail"))
            var type = $(el).attr("data-type")
            var subtotal = parseInt($("#subtotal").val()) 

            var qtyInput = $(`#qty-${detail.id}`)
            var qtyValue = parseInt(qtyInput.val())

            var subtotal 
            var newQty

            if(type == "min") {
                if (qtyValue == 1) return
                newQty = qtyValue - 1
                qtyInput.val(newQty)
            }else {
                if (qtyValue == detail.stok) return  
                newQty = qtyValue + 1
                qtyInput.val(newQty)
            }

            subtotal = detail.selling_price * newQty
            $(`#subtotal-${detail.id}`).val(subtotal)
            $(`#display-subtotal-${detail.id}`).text(formatter.format(subtotal))
            calculateTotal()
        }

        function calculateTotal() {
            var subtotalPerItem = $("input[name='subtotal-per-item']")
            var subtotal = 0 

            for (let i = 0; i < subtotalPerItem.length; i++) {
                const element = subtotalPerItem[i]
                const value = parseInt($(element).val())
                subtotal = subtotal + value
            }

            // calculate ppn 
            var ppn = subtotal * (10/100)
            var total = subtotal + ppn

            // subtotal assign to DOM
            $("#subtotal").val(subtotal)
            $("#subtotal_display").val(formatter.format(subtotal))

            // total assign to DOM
            $("#payment_total_display").val(formatter.format(total))
            $("#payment_total").val(total)

            // ppn assign to DOM
            $("#ppn_display").val(formatter.format(ppn))
            $("#ppn").val(ppn)
        }

        function preview() {
            $("#modal-preview").modal("show")
            $("#ppn-preview").text(formatter.format($("#ppn").val()))
            $("#total-preview").text(formatter.format($("#payment_total").val()))
            $("#payment-preview").text(formatter.format($("#payment").val()))
            $("#return-preview").text($("#return_display").val())
            $("#payment-method-preview").text($("#payment_method").val())
            $("#subtotal-preview").text(formatter.format($("#subtotal").val()))
            $("#preview-product").html("")
            
            // hitung total quantitas item
            const quantity = $("input[name='quantity-per-item']")
            var totalQty = 0
            for (let i = 0; i < quantity.length; i++) {
                let element = quantity[i];
                let value = parseInt($(element).val())
                totalQty = totalQty + value
            }
            $("#total_qty").text(totalQty)

            // ambil item
            const items = $("input[name='item']")
            for (let i = 0; i < items.length; i++) {
                let element = items[i]
                let itemDetail = JSON.parse($(element).val())
                let qty = $(`#qty-${itemDetail.id}`).val()

                $("#preview-product").append(createProductPreview(itemDetail, qty))
            }
        }

        function createProductPreview(data, qty) {
            return `
                <tr>
                    <td> ${data.name} </td>
                    <td> ${formatter.format(data.selling_price)} </td>
                    <td> ${qty} </td>
                    <td> ${formatter.format(data.selling_price * qty)} </td>
                </tr>
            `
        }

        function submitPayment() {
            var items = []

            // get item 
            const itemInput = $("input[name='item']")
            for (let i = 0; i < itemInput.length; i++) {
                const element = itemInput[i]
                let item = JSON.parse($(element).val())
                let qty = $(`#qty-${item.id}`).val()
                items.push({
                    item_id: item.id,
                    qty
                })
            }

            if (itemInput.length < 1) {
                $("#modal-swal").modal("show")
                $("#swal-title").text("Whoops! terjadi kesalahan")
                $("#swal-content").text('Item Belanja Masih Kosong')
                return
            }

            const data = {
                buyer_name : $("#buyer_name").val(),
                buyer_address : $("#buyer_address").val(),
                buyer_contact : $("#buyer_contact").val(),
                subtotal : $("#subtotal").val(),
                total : $("#payment_total").val(),
                payment : $("#payment").val(),
                return : $("#return").val(),
                payment_method : $("#payment_method").val(),
                items
            }
          
            submit(data)
        }

        function submit(data) {
            $.ajax({
                url:"{{ route('transaction.create') }}",
                type: "post",
                contentType: 'json',
                processData: false,
                data : JSON.stringify(data),
                contentType: "application/json",
                beforeSend: function(){
                    $("#modal-swal").modal("show")
                    $("#swal-title").text("Mohon Tunggu")
                    $("#swal-content").text('Sedang Menambah Produk Baru')
                    $("#notif-foot").hide()
                },
                success : function(res){
                    systemNotification(res)
                }
            })
        }

        function systemNotification(res) {
            if (res.fail && res.error_message != "") {
                $("#modal-preview").modal("hide")
                $("#swal-title").text("Transaksi Gagal")
                $("#swal-content").text(res.error_message)
                $("#notif-foot").show()
                return
            }

            if (res.fail) {
                $("#modal-swal").modal("hide")
                $("#modal-preview").modal("hide")
                $("#payment-feedback").removeClass("d-none")
                $("#payment-feedback").text("tidak bolek kosong")
                $("#payment").addClass("is-invalid")
                return
            }

            if (!res.fail) {
                $("#modal-preview").modal("hide")
                $("#swal-title").text("Transaksi Tersimpan")
                $("#swal-content").text('Transaksi Berhasil Tersimpan Dengan Baik')
                $("#notif-foot").show()
                return
            }
        }

        function resetForm() {
            const itemInput = $("input[name='item']")
            if (itemInput.length < 1) {
                $("#modal-swal").modal("hide")
                $("#modal-preview").modal("hide")
                return false
            }else {
                location.reload()
                return false
            }
        }
    </script>
@endpush