@extends('admin.layout.main')

@section('pageName')
    Edit Product
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Product</a></li>
              <li class="breadcrumb-item active">Form Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <a class="btn btn-secondary btn-sm" href="{{ route('admin.product.index') }}"> <i class="fas fa-arrow-left"></i> Back</a></h3>
              </div>
              <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('admin.product.update', $data['product']->id) }}" id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Product Code <span class="text-red">*</span></label>
                        <div class="col-sm-2">
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Product Code" maxlength="10" value="{{ $data['product']->product_code }}" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Product Name <span class="text-red">*</span></label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" maxlength="20" value="{{ $data['product']->product_name }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Unit <span class="text-red">*</span></label>
                        <div class="col-sm-3">
                        <select class="form-control" id="unit_id" name="unit_id">
                            @foreach ($data['unit'] as $item)
                                <option value="{{ $item->id }}" {{ $data['product']->unit_id == $item->id ? 'selected' : '' }} >{{ $item->unit_name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category <span class="text-red">*</span></label>
                        <div class="col-sm-3">
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach ($data['category'] as $item)
                                <option value="{{ $item->id }}" {{ $data['product']->category_id == $item->id ? 'selected' : '' }} >{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Stock <span class="text-red">*</span></label>
                        <div class="col-sm-2">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ $data['product']->stock }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Stock Min. <span class="text-red">*</span></label>
                        <div class="col-sm-2">
                        <input type="number" class="form-control" id="stock_min" name="stock_min" placeholder="Stock Min." value="{{ $data['product']->stock_min }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Price Purchase <span class="text-red">*</span></label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" id="price_purchase" name="price_purchase" placeholder="Price Purchase" value="{{ $data['product']->price_purchase }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Price Sale <span class="text-red">*</span></label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" id="price_sale" name="price_sale" placeholder="Price Sale" value="{{ $data['product']->price_sale }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Price Reseller <span class="text-red">*</span></label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" id="price_reseller" name="price_reseller" placeholder="Price Reseller" value="{{ $data['product']->price_reseller }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Image <span class="text-red">*</span> <br/>
                        *Size 450 x 600 pixel</label>
                        <div class="col-sm-4">
                            {{-- <input type="file" class="" id="image" name="image"> --}}
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="inputfile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <img id="img_viewer" src="{{ Storage::url($data['product']->image) }}" alt="your image" height="600px" width="450px" />
                        </div>
                    </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button id="btn_save" type="submit" class="btn btn-info"> <span class="fas fa-save" role="status" aria-hidden="true">&nbsp;</span> Save</button>
                    <button id="btn_reset" type="reset" class="btn btn-danger"> <span class="fas fa-eraser" role="status" aria-hidden="true">&nbsp;</span></i> Reset</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection


  @push('javascript')

  <script>
      $(document).ready( function(e) {

        function readImage(input){
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#img_viewer').attr('src', e.target.result);
                    $("#img_viewer").css("display","block");
                }
                reader.readAsDataURL(input.files[0]);
            }else if(input == "null"){
                $('#img_viewer').css("display","none");
            }
        }

        // Show Image After Choose File
        $("#image").change(function(){
                readImage(this);
        });

        // Submit Form
        $('#form').on('submit', function(e) {
            e.preventDefault();
            if(confirm("Apakah yakin ingin submit ? ")){
                let me = $(this),
                    url = me.attr('action');
                    method = me.attr('method'),
                    data = new FormData(this);
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "JSON",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(e){
                        $('#btn_save > span').removeClass();
                        $('#btn_save > span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(res){
                        toastrSuccess(res.message);
                        window.location.href = "{{ route('admin.product.index') }}";
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
                        $('#btn_save > span').removeClass();
                        $('#btn_save > span').addClass('fas fa-save');
                    }
                });
            }
        });
        // End Submit Form

      });
  </script>

  @endpush
