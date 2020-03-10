<div class="table-responsive">
 <table class="table table-bordered table-striped">
    <thead>
        <th>#</th>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Sub. Total</th>
        <th>#</th>
    </thead>
    <tbody>
    @if ( is_null($data) )
        <tr>
            <td colspan="7">Belum ada barang di transaksi, silahkan input barang</td>
        </tr>
    @else
        @foreach ($data->tmp_details as $key => $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->product->product_code }}</td>
            <td>{{ $item->product->product_name }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->sub_total }}</td>
            <td>
                <a href="{{ route('admin.transaction.sale.destroy_tmpdetail', $item->id) }}" class="btn btn-sm btn-danger" id="btn_delete"><span class="fas fa-times"></span></a>
            </td>
        </tr>
        @endforeach
    @endif
    </tbody>
</table>
</div>
