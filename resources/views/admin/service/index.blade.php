@extends('admin.layout.master')
@section('title', 'Service')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Service</h1>
      </div>
      <div class="col-sm-6">
        
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Service</h3>
            <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Add</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="" class="table  table-striped table-bordered">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Icon</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               @if($services)
               @foreach($services as $service)
                <tr>
                  <td>{{$service->title}}</td>
                  <td>{{$service->icon}}</td>
                  <td>
                  <a href="javaScript:void(0)" class="btn btn-icon btn-warning mr-1 btn-sm" onclick="editService({{$service->id}})"><i class="fa fa-edit"></i></a>
                  
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="
                    if (confirm('are you sure to delete?')) {
                      document.getElementById('delete_form_{{$service->id}}').submit();
                    }
                    "><i class="fa fa-trash"></i></a>
                    <form action="{{route('service.destroy',$service->id)}}" id="delete_form_{{$service->id}}" method="post">
                      @csrf
                      @method('DELETE')
                    </form>
                  </td>
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>


      </div>

    </div>
  </div>
</section>

<!--Service create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                             </div>
                             <form class="form" action="{{route('service.store')}}" method="post" enctype="multipart/form-data">
                             @csrf
                             <div class="modal-body">

                             <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text"  class="form-control" name="title">
                                           </div>
                                       </div>

                                       <div class="col-md-12" >
                                           <div class="form-group">
                                            <label for="icon">Icon</label>
                                            <input type="text"  class="form-control" name="icon">
                                           </div>
                                       </div>
                                </div>
                            
                             </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <input type="submit" class="btn btn-primary">
                                  </div>
                          </form>
                 </div>
              </div>
          </div>

          <!-- Pricing create modal -->


<!--Service  edit Modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                             </div>
                             <form class="form" action="{{route('service.update',$service->id)}}" method="post" enctype="multipart/form-data">
                             @csrf
                             @method('PUT')
                             <div class="modal-body">

                             <div class="row">
                                       <div class="col-md-12">
                                           <input type="hidden" id="id_edit" name="id">
                                           <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" id="title_edit"  class="form-control" name="title" value="">
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                            <label for="icon">Icon</label>
                                            <input type="text" id="icon_edit" class="form-control" name="icon" value="">
                                           </div>
                                       </div>
                                </div>
                            
                             </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <input type="submit" class="btn btn-primary">
                                  </div>
                          </form>
                 </div>
              </div>
          </div>


<!-- Banner  edit modal -->
@endsection

@section('script')
<script>
              function editService(id) {
                 $.ajax({
                 url:"{{route('edit_service')}}",
                 method:"POST",
                 data:{'id':id ,'_token': '{{csrf_token()}}'},
                 dataType:'JSON',
                 success:function(response){
                    $('#id_edit').val(response.data.id)
                    $('#title_edit').val(response.data.title)
                    $('#icon_edit').val(response.data.icon)
                    $('#editModal').modal('show')
                 },
                 error:function(jqr,execption){

                }
            });

        }
</script>
@endsection
<!-- /.content-wrapper -->


