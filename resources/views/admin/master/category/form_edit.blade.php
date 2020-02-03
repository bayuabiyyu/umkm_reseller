@extends('admin.layout.main')

@section('pageName')
    Edit Category
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Category</a></li>
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
                <h3 class="card-title"> <a class="btn btn-secondary btn-sm" href="{{ route('admin.category.index') }}"> <i class="fas fa-arrow-left"></i> Back</a></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('admin.category.update', $data->id) }}" id="form" method="PUT" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category Code <span class="text-red">*</span></label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="category_code" name="category_code" placeholder="Category Code" maxlength="10" value="{{ $data->category_code }}" readonly required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category Name <span class="text-red">*</span></label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name" maxlength="20" value="{{ $data->category_name }}" required>
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

        // Submit Form
        $('#form').on('submit', function(e) {
            e.preventDefault();
            if(confirm("Apakah yakin ingin submit ? ")){
                let me = $(this),
                    url = me.attr('action');
                    method = me.attr('method'),
                    data = me.serialize();
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "JSON",
                    data: data,
                    beforeSend: function(e){
                        $('#btn_save > span').removeClass();
                        $('#btn_save > span').addClass('spinner-border spinner-border-sm');
                    },
                    success: function(res){
                        toastrSuccess(res.message);
                        window.location.href = "{{ route('admin.category.index') }}";
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
