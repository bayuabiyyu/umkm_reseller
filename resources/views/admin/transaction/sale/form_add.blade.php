@extends('admin.layout.main')

@section('pageName')
    Form Transaction
@endsection

@push('css')
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaction Sale Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaction</a></li>
              <li class="breadcrumb-item"><a href="#">Sale</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><span class="fas fa-user"></span> &nbsp; Customer Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">ID <span class="text-red">*</span> </label>
                        <div class="col-sm-9">
                            <select class="form-control" name="customer_id" id="customer_id">
                                <option value="">-- Choose --</option>
                                    @foreach ($data['customer'] as $item)
                                        <option value="{{ $item->id }}" {{ ( !is_null($data['sale']) && !is_null($data['sale']->customer_id) )  && $data['sale']->customer_id == $item->id ? "selected" : "" }} >{{ $item->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name <span class="text-red">*</span> </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Name" value="{{ ( !is_null($data['sale']) && !is_null($data['sale']->customer_id) ) && $data['sale']->customer->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Address <span class="text-red">*</span> </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="" id="" cols="4" rows="5" id="customer_address" name="customer_address" placeholder="Address" readonly>{{ ( !is_null($data['sale']) && !is_null($data['sale']->customer_id) ) && $data['sale']->customer->address }}</textarea>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
          </div>
          <!-- /.col (left) -->
          <div class="col-md-8">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><span class="fas fa-exchange-alt"></span> &nbsp; Transaction Information</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Note</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="" id="" cols="4" rows="5">{{ !is_null($data['sale']) && $data['sale']->note }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-12 col-form-label"><h3>Total</h3></label>
                                <div class="col-sm-12">
                                    <h1 id="sub_total_sum_detail">{{ !is_null($data['sale']) ? number_format( $data['sale']->tmp_details->sum('sub_total') ) : "" }}</h1>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-primary"> <span class="fas fa-check"></span> Proccess</button>
                                    <button class="btn btn-danger"> <span class="fas fa-trash"></span> Cancel</button>
                                    <button class="btn btn-info"> <span class="fas fa-arrow-right"></span> New Transaction</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
          </div>
          <!-- /.col (right) -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" id="btn_list_product" ><span class="fa fa-list"></span> &nbsp; List Product</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                              <div class="form-group col-md-3">
                                <label for="inputCity">Product Code</label>
                                <input type="text" class="form-control" name="code_product" id="code_product" readonly>
                                <input type="hidden" class="form-control" name="id_product" id="id_product" readonly>
                              </div>
                              <div class="form-group col-md-3">
                                <label for="inputCity">Product Name</label>
                                <input type="text" class="form-control" name="name_product" id="name_product" readonly>
                              </div>
                              <div class="form-group col-md-2">
                                <label for="inputCity">Price</label>
                                <input type="text" class="form-control" name="price_product" id="price_product">
                              </div>
                              <div class="form-group col-md-1">
                                <label for="inputCity">Qty</label>
                                <input type="text" class="form-control" name="qty_product" id="qty_product">
                              </div>
                              <div class="form-group col-md-2">
                                <label for="inputCity">Sub. Total</label>
                                <input type="text" class="form-control" name="sub_total_product" id="sub_total_product" readonly>
                              </div>
                              <div class="form-group col-md-1">
                                <label class="" for="Save">&nbsp;</label>
                                <button class="form-control btn btn-primary" id="btn_add_product"> <span class="fas fa-plus"></span> </button>
                              </div>
                            </div>
                          </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title"> <span class="fas fa-tasks"></span> &nbsp; Product Detail</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id="list_product_detail">

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      * Please check your product code again
                    </div>
                  </div>
                  <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal List Product -->
  <div class="modal fade" id="modal_list_product">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered" id="data_list_product">
            <thead>
              <tr>
                <th>No.</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

@endsection

@push('javascript')
<!-- Select2 -->
<script src="{{ asset('assets/admin') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="{{ asset('assets/admin') }}/plugins/daterangepicker/daterangepicker.js"></script>

    <script>

        $(document).ready(function(){

            loadProductDetail();

            function initTableListProduct()
            {
                // Init Datatable List Product
                let table = $("#data_list_product").DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    destroy: true,
                    order: [],
                    ajax: {
                        url: "{{ route('admin.product.datatables_forsale') }}",
                        type: "POST"
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        { data: 'product_code', name: 'product_code' },
                        { data: 'product_name', name: 'product_name' },
                        { data: 'unit_name', name: 'unit_name' },
                        { data: 'category_name', name: 'category_name' },
                        { data: 'stock', name: 'stock' },
                        { data: 'price_sale', name: 'price_sale' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ]
                });
            }

            // Customer ID Change Event
            $('#customer_id').on('change', function(e){

                let me = $(this),
                    url = '{{ route("admin.customer.getbyid") }}',
                    method = "POST";
                    data = {
                        customer_id: me.val()
                    };

                $.ajax({
                    url: url,
                    type: method,
                    dataType: "JSON",
                    data: data,
                    success: function(res){
                        // Get data from backend and fill to the form customer
                        let id = res.id,
                            name = res.data.name,
                            address = res.data.address;
                        $('#customer_name').val(name);
                        $('#customer_address').val(address);
                    },
                    error: function(xhr, textStatus, errorThrow){
                        let error = xhr.responseJSON.errors,
                            message = xhr.responseJSON.message;
                        error.forEach(element => {
                            message += "<li>"+ element +"</li>"
                        });
                        toastrError(message);
                    },
                });

            });


            // List product click
            $('#btn_list_product').on('click', function(e){
                    e.preventDefault();
                    initTableListProduct();
                    $('#modal_list_product').modal('show');
            });

            // Button Pilih From List Product Click
            $('#data_list_product').on('click', '#btn_pilih', function(e){
                e.preventDefault();
                // Get data from datatable clickable button
                let data = $('#data_list_product').DataTable().row( $(this).parents('tr') ).data();
                clearInputProductDetail();
                $('#id_product').val(data.id);
                $('#code_product').val(data.product_code);
                $('#name_product').val(data.product_name);
                $('#price_product').val(data.price_sale);
                $('#modal_list_product').modal('hide');
                $('#qty_product').focus();

            });

            // Hitung Qty * Harga
            $('#qty_product, #price_product').on('keyup keypress blur change', function(e){
                let qty = $('#qty_product').val();
                let price = $('#price_product').val();
                let sub_total_product = qty * price;
                $('#sub_total_product').val(sub_total_product);
            });

            // Delete From Product Detail
            $('#list_product_detail').on('click', '#btn_delete', function(e){
                e.preventDefault();
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
                        loadProductDetail();

                        // Get sub total sum from backend
                        let sub_total_sum = res.data.sub_total_sum;
                        $('#sub_total_sum_detail').html(sub_total_sum);

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
                        me.find('span').addClass('fas fa-times');
                    }
                });

            });

            // Submit Detail Product to Tmp Detail

            // Submit Form Add Product
            $('#btn_add_product').on('click', function(e) {
                e.preventDefault();
                if(confirm("Apakah yakin ingin menambah product tersebut ?")){
                    let me = $(this),
                        url = '{{ route("admin.transaction.sale.store_tmpdetail") }}',
                        method = "POST";
                    let data = {
                            id_product: $('#id_product').val(),
                            code_product: $('#code_product').val(),
                            price_product: $('#price_product').val(),
                            qty_product: $('#qty_product').val(),
                            sub_total_product: $('#sub_total_product').val(),
                        };

                    $.ajax({
                        url: url,
                        type: method,
                        dataType: "JSON",
                        data: data,
                        beforeSend: function(e){
                            $('#btn_add_product > span').removeClass();
                            $('#btn_add_product > span').addClass('spinner-border spinner-border-sm');
                        },
                        success: function(res){
                            toastrSuccess(res.message);
                            clearInputProductDetail();
                            loadProductDetail();

                            // Get sub total sum from backend
                            let sub_total_sum = res.data.sub_total_sum;
                            $('#sub_total_sum_detail').html(sub_total_sum);

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
                            $('#btn_add_product > span').removeClass();
                            $('#btn_add_product > span').addClass('fas fa-plus');
                        }
                    });
                }
            });
            // End Submit Form

            // Clear input product detail
            function clearInputProductDetail()
            {
                $('#id_product').val(null);
                $('#code_product').val(null);
                $('#name_product').val(null);
                $('#price_product').val(null);
                $('#qty_product').val(null);
                $('#sub_total_product').val(null);
            }

            // Load product detail from backend berupa tabel
            function loadProductDetail()
            {
                let url = '{{ route("admin.transaction.sale.gettable_tmpdetail") }}',
                    method = "GET";
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "HTML",
                    success: function(res){
                        let html = res;
                        $('#list_product_detail').html(html);
                    },
                    error: function(xhr, textStatus, errorThrow){
                        toastrError("Error load product detail");
                    },
                });

            }

        });

    </script>

@endpush
