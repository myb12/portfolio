@extends('admin.layout.master')
@section('title', 'Skills')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Skill</h1>
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
            <h3 class="card-title">Skill</h3>
            <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Add</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="" class="table  table-striped table-bordered">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Percentage</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               @if($skills)
               @foreach($skills as $skill)
                <tr>
                  <td>{{$skill->title}}</td>
                  <td>{{$skill->percentage}}%</td>
                  <td>
                  <a href="javaScript:void(0)" class="btn mr-1 btn-warning " onclick="editSkill({{$skill->id}})"><i class="fa fa-edit"></i></a>
                  
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="
                    if (confirm('are you sure to delete?')) {
                      document.getElementById('delete_form_{{$skill->id}}').submit();
                    }
                    "><i class="fa fa-trash"></i></a>
                    <form action="{{ route('skill.destroy',$skill->id) }}" id="delete_form_{{$skill->id}}" method="post">
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

<!--Skill create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                             </div>
                             <form class="form" action="{{route('skill.store')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="percentage">Percentage</label>
                                            <input type="number"  class="form-control" name="percentage">
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


<!--Skill  edit Modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Skill</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                             </div>
                             <form class="form" action="{{route('skill.update',$skill->id)}}" method="post" enctype="multipart/form-data">
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
                                            <label for="percentage">Percentage</label>
                                            <input type="text" id="percentage_edit" class="form-control" name="percentage" value="">
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
        //       function editSkill(id) {
        //          $.ajax({
        //          url:"{{route('edit_skill')}}",
        //          method:"POST",
        //          data:{'id':id ,'_token': '{{csrf_token()}}'},
        //          dataType:'JSON',
        //          success:function(response){
        //             // $('#edit-form').html(response.data)
        //             $('#id_edit').val(response.data.id)
        //             $('#title_edit').val(response.data.title)
        //             $('#percentage_edit').val(response.data.percentage)
        //             $('#editModal').modal('show')
        //          },
        //          error:function(jqr,execption){

        //         }
        //     });

        // }







        async function editSkill(id){
          const res = await fetch('{{route('edit_skill')}}', 
          { 
            method: 'POST',
            headers : { 
                       'Content-Type': 'application/json'
                       },
            body:JSON.stringify({'id':id ,'_token': '{{csrf_token()}}'})
            });

          const data =await res.json();
          $('#id_edit').val(data.data.id)
          $('#title_edit').val(data.data.title)
          $('#percentage_edit').val(data.data.percentage)
          $('#editModal').modal('show')
          // console.log(data);
        }
</script>
@endsection
<!-- /.content-wrapper -->


