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
                <h1 class="m-0">Invoice</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/report">Laporan</a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="parent">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> D'Curhat
                                <small class="float-right">Tanggal:{{ $transaction->created_at }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
    
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <address>
                                <strong>D'Curhat</strong><br>
                                NPWP : 01.709.021.8-420002<br>
                                Alamat : Jl.Cikawao No.01-03 Bandung<br>
                                Telp : (022) 423 0531<br>
                            </address>
                        </div>

                        <div class="col-sm-6 invoice-col">
                            <div class="d-flex justify-content-end">
                                <b>No Invoice {{ $transaction->no_invoice }}</b><br>
                            </div>
                        </div>
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
                                    @foreach($transaction->transaction_item as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ "Rp ". number_format($item->product->selling_price,2,',','.') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ "Rp ". number_format($item->product->selling_price * $item->quantity, 2,',','.') }}</td>
                                        </tr>
                                    @endforeach
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
                                        <td id="subtotal-preview"> {{ "Rp ". number_format($transaction->subtotal,2,',','.') }} </td>
                                    </tr>
                                    <tr>
                                        <th>PPN (10%):</th>
                                        <td id="ppn-preview">{{ "Rp ". number_format($transaction->subtotal * (10/100) ,2,',','.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td id="total-preview"> {{ "Rp ". number_format($transaction->total ,2,',','.') }} </td>
                                    </tr>
                                    <tr>
                                        <th>Bayar:</th>
                                        <td id="payment-preview"> {{ "Rp ". number_format($transaction->payment ,2,',','.') }} </td>
                                    </tr>
                                    <tr>
                                        <th>Kembali:</th>
                                        <td id="return-preview"> {{ "Rp ". number_format($transaction->return ,2,',','.') }} </td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran:</th>
                                        <td id="payment-method-preview">{{ $transaction->payment_method }}</td>
                                    </tr>
                                    <tr>
                                        <th>Items:</th>
                                        <td id="total_qty"> 
                                            <?php $qtot = 0;?>
                                            @foreach($transaction->transaction_item as $item)
                                                <?php  $qtot = $qtot + $item->quantity; ?>
                                            @endforeach
                                            <?php echo $qtot." item" ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
    
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-right" onclick="myApp.printDiv()">
                                <i class="far fa-credit-card"></i> 
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

@endsection

@push('scripts')
<script>
    var myApp = new function () {
    this.printDiv = function () {
        // Store DIV contents in the variable.
        var div = document.getElementById('parent');

        // Create a window object.
        var win = window.open('', '', 'height=1000,width=1000'); // Open the window. Its a popup window.
        win.document.write(div.outerHTML);     // Write contents in the new window.
        win.document.close();
        win.print();       // Finally, print the contents.
    }}
</script>
@endpush