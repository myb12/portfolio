@extends('admin.layout.master')
@section('title', 'Contact')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Contact</h1>
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
            <h3 class="card-title">Contact</h3>
            <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>Add</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="" class="table  table-striped table-bordered">
              <thead>
                <tr>
                  <th>phone</th>
                  <th>email</th>
                  <th>facebook</th>
                  <th>linkedin</th>
                  <th>git</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               
               @if($contacts)
               @foreach($contacts as $contact)
                <tr>
                  <td>{{$contact->phone}}</td>
                  <td>{{$contact->email}}</td>
                  <td>{{$contact->facebook}}</td>
                  <td>{{$contact->linkedin}}</td>
                  <td>{{$contact->git}}</td>
                  <td>

                  <a  class="btn btn-warning" href="javaScript:void(0)" onclick="editContact({{$contact->id}})"><i class="fa fa-edit"></i></a>
                  <a  class="btn btn-danger" href="javascript:void(0)" onclick="
                    if(confirm('Are you sure to delete?')){
                      getElementById('delete_form_{{$contact->id}}').submit();
                    }
                  "><i class="fa fa-trash"></i></a>

                  <form action="{{route('contact.destroy',$contact->id)}}" id="delete_form_{{$contact->id}}" method="post">
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

<!--Contact create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                             </div>
                             <form class="form" action="{{route('contact.store')}}" method="post" enctype="multipart/form-data">
                             @csrf
                             <div class="modal-body">

                             <div class="row">
                                       <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="phone">Phone</label>
                                              <input type="tel"  class="form-control" name="phone">
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="email">Email</label>
                                              <input type="email"  class="form-control" name="email">
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="facebook">Facebook</label>
                                              <input type="text"  class="form-control" name="facebook">
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="linkedin">Linkedin</label>
                                              <input type="text"  class="form-control" name="linkedin">
                                           </div>
                                       </div>

                                       <div class="col-md-12" >
                                           <div class="form-group">
                                              <label for="git">Git</label>
                                              <input type="text"  class="form-control" name="git">
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


<!--Contact  edit Modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                             </div>
                             <form class="form" action="{{route('contact.update',$contact->id)}}" method="post" enctype="multipart/form-data">
                             @csrf
                             @method('PUT')
                             <div class="modal-body">

                             <div class="row">
                                        
                                    <div class="col-md-12">
                                    <input type="hidden" id="id_edit" name="id">
                                           <div class="form-group">
                                              <label for="phone">Phone</label>
                                              <input type="tel" id="phone_edit"  class="form-control" name="phone">
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="email">Email</label>
                                              <input type="email" id="email_edit"  class="form-control" name="email">
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="facebook">Facebook</label>
                                              <input type="text" id="facebook_edit" class="form-control" name="facebook">
                                           </div>
                                       </div>

                                       <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="linkedin">Linkedin</label>
                                              <input type="text" id="linkedin_edit"  class="form-control" name="linkedin">
                                           </div>
                                       </div>

                                       <div class="col-md-12" >
                                           <div class="form-group">
                                              <label for="git">Git</label>
                                              <input type="text" id="git_edit" class="form-control" name="git">
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
              function editContact(id) {
                 $.ajax({
                 url:"{{route('edit_contact')}}",
                 method:"POST",
                 data:{'id':id ,'_token': '{{csrf_token()}}'},
                 dataType:'JSON',
                 success:function(response){
                    $('#id_edit').val(response.data.id)
                    $('#phone_edit').val(response.data.phone)
                    $('#email_edit').val(response.data.email)
                    $('#facebook_edit').val(response.data.facebook)
                    $('#linkedin_edit').val(response.data.linkedin)
                    $('#git_edit').val(response.data.git)
                    $('#editModal').modal('show')
                 },
                 error:function(jqr,execption){

                }
            });

        }
</script>
@endsection
<!-- /.content-wrapper -->


