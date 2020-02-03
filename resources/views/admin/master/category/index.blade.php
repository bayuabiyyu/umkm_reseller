@extends('admin.layout.main')

@section('pageName')
    Category
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Category</a></li>
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
                <h3 class="card-title"><a href="{{ route('admin.category.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> New Data</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Category Code</th>
                  <th>Category Name</th>
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
                order: [],
                ajax: {
                    url: "{{ route('admin.category.datatables') }}",
                    type: "POST"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'category_code', name: 'category_code' },
                    { data: 'category_name', name: 'category_name' },
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
