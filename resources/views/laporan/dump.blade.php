<table id="report-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No.Invoice</th>
            <th>Subtotal</th>
            <th>PPN 10%</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
            <th>Metode Pembayaran</th>
            <th>Tgl. Transaksi</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->no_invoice }}</td>
                <td>{{ "Rp ". number_format($transaction->subtotal,2,',','.') }}</td>
                <td>{{ "Rp ". number_format($transaction->subtotal * (10 / 100),2,',','.')  }}</td>
                <td>{{ "Rp ". number_format($transaction->total,2,',','.') }}</td>
                <td>{{ "Rp ". number_format($transaction->payment,2,',','.') }}</td>
                <td>{{ "Rp ". number_format($transaction->return,2,',','.') }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>
                    <center>
                        <a href="{{ route('laporan.invoice', $transaction->id) }}" class="btn btn-success" >Lihat Invoice</a>
                    </center>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<form action="#" id="filter-form" method="get">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="start_date">Tanggal Awal</label>
                <input type="date" name="start_date" id="start_date" class="form-control">
            </div>
        </div>

        <div class="col-6">
            <label for="end_date">Tanggal Awal</label>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Filter Laporan</button>
            </div>
        </div>
    </div>
</form>