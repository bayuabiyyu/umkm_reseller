@extends('admin.layout.main')

@section('pageName')
    Product
@endsection

@push('css')
    <style>
        th, td {
            white-space: nowrap;
            }
    </style>
@endpush

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Product</a></li>
              <li class="breadcrumb-item active">Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title"><a href="{{ route('admin.product.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> New Data</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data" class="table table-bordered table-striped display" style="width:100%">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Unit</th>
                  <th>Stock</th>
                  <th>Stock Min</th>
                  <th>Price Purchase</th>
                  <th>Price Sale</th>
                  <th>Price Reseller</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  @endsection

  @push('javascript')
    <script>
        $(document).ready(function(){
            // Init Datatable
            let table = $("#data").DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [],
                ajax: {
                    url: "{{ route('admin.product.datatables') }}",
                    type: "POST"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'product_code', name: 'product_code' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'unit_name', name: 'unit_name' },
                    { data: 'stock', name: 'stock' },
                    { data: 'stock_min', name: 'stock_min' },
                    { data: 'price_purchase', name: 'price_purchase' },
                    { data: 'price_sale', name: 'price_sale' },
                    { data: 'price_reseller', name: 'price_reseller' },
                    { data: 'image', name: 'image' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });

            // Action Delete
            $('#data').on('click', '#btn_delete', function(e){
                e.preventDefault();
                if(confirm('Apakah yakin ingin delete data ? ')){

                    let me = $(this),
                        url = me.attr('href'),
                        method = "DELETE";

                    $.ajax({
                        url: url,
                        type: method,
                        dataType: "JSON",
                        beforeSend: function(e){
                            me.find('span').removeClass();
                            me.find('span').addClass('spinner-border spinner-border-sm');
                        },
                        success: function(res){
                            toastrSuccess(res.message);
                            table.ajax.reload();
                        },
                        error: function(xhr, textStatus, errorThrow){
                            let error = xhr.responseJSON.errors,
                                message = xhr.responseJSON.message;
                            error.forEach(element => {
                                message += "<li>"+ element +"</li>"
                            });
                            toastrError(message);
                        },
                        complete: function(e){
                            me.find('span').removeClass();
                            me.find('span').addClass('fas fa-save');
                        }
                    });
                }
            });

        });
    </script>

  @endpush
