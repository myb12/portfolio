@extends('admin.layout.master')
@section('title', 'about')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>About</h1>
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
            <h3 class="card-title">About Me</h3>
            <a href="{{ route('about.create') }}" class="btn btn-success float-right">Add New About</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>Note</th>
                  <th>Description</th>
                  <th>Image</th>
                </tr>
              </thead>
              <tbody>
              @if($abouts)
                @foreach($abouts as $about)
                <tr>
                  <td>{{$about->name}}</td>
                  <td>{{$about->designation}}</td>
                  <td>{{$about->note}}</td>
                  <td>{{ Str::words(strip_tags($about->description, 20)) }}</td>
                  <td>
                            <img height="100px" width="100px"src="{{Storage::url($about->image)}}">
                  </td>
                  <td>
                    <a href="javaScript:void(0)" class="btn btn-icon btn-warning mr-1" onclick="editAbout({{$about->id}})"><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="
                    if (confirm('are you sure to delete?')) {
                      document.getElementById('delete_form_{{$about->id}}').submit();
                    }
                    "><i class="fa fa-trash"></i></a>
                    <form action="{{ route('about.destroy',$about->id) }}" id="delete_form_{{$about->id}}" method="post">
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


<div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content ">
            <div class="modal-header">
              <h2 class="modal-title" id="about-name"> Edit about info</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form" action="{{route('about.update',$about->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
            <div class="modal-body" id="edit-form">
             
            </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary">
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endsection

@section('script')
<script type="text/javascript">

async function editAbout(id){
          const res = await fetch('{{route('edit_about')}}', 
          { 
            method: 'POST',
            headers : { 
                       'Content-Type': 'application/json'
                       },
            body:JSON.stringify({'id':id ,'_token': '{{csrf_token()}}'})
            });

            const data =await res.json();

            $('#edit-form').html(data.data)
            $('#editModal').modal('show')
      }
</script>
@endsection
<!-- /.content-wrapper -->


