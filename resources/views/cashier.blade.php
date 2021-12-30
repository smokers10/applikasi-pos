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
                        <form action="#" id="buy-form">
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

                            <h3>Detail Pembelian</h3>

                            <div class="row">
                                <div class="col-lg-8">
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
                                    <div class="form-group">
                                        <label for="total">Total Belanja</label>
                                        <input type="text" name="payment_total_display" id="payment_total_display" disabled="disabled" class="form-control" value="0">
                                        <input type="hidden" name="payment_total" id="payment_total" disabled="disabled" class="form-control" value="0">
                                    </div>

                                    <div class="form-group">
                                        <label for="total">Bayar*</label>
                                        <input type="number" name="payment" id="payment" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="total">Kembalian</label>
                                        <input type="text" name="return_display" id="return_display" disabled="disabled" class="form-control">
                                        <input type="hidden" name="return" id="return" disabled="disabled" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">OKE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

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

        $("#buy-form").submit(function(e){
            e.preventDefault()

        })

        function chooseProduct(){
            $("#modal-product").modal("show")
        }

        function addToCart(el){
            var detail = JSON.parse($(el).attr("detail"))
            var total_payment = parseInt($("#payment_total").val())
            var newTot = total_payment + detail.selling_price
            $("#payment_total").val(newTot)
            $("#payment_total_display").val(formatter.format(newTot))
            $("#cart-item").append(cartItemElement(detail))
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
                                <input id="subtotal-${data.id}" type="hidden" name="subtotal" value="${data.selling_price}"/>
                                <input id="qty-${data.id}" type="number" class="form-control form-control-sm" value="1" min="${data.stok}" max="${data.stok}" disabled="disabled"/>
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
            var total_payment = parseInt($("#payment_total").val())
            var qty = parseInt($(`#qty-${detail.id}`).val())
            var newTot = total_payment - (detail.selling_price * qty)
            $("#payment_total").val(newTot)
            $("#payment_total_display").val(formatter.format(newTot))
            $(`#item-${detail.id}`).remove()
        }

        function changeQty(el) {
            var detail = JSON.parse($(el).attr("detail"))
            var type = $(el).attr("data-type")
            var total_payment = parseInt($("#payment_total").val()) 

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
            var subtotal = $("input[name='subtotal']")
            var total = 0 
            for (let i = 0; i < subtotal.length; i++) {
                const element = subtotal[i];
                const value = parseInt($(element).val())
                total = total + value
            }
            $("#payment_total").val(total)
            $("#payment_total_display").val(formatter.format(total))
        }
    </script>
@endpush