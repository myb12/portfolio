@extends('admin.layout.master')
@section('title','about')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>About</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">About</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">

    <div class="container-fluid w-50">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Add About</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('about.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Title..." value="{{old('name')}}">
                                @error('name')
                                <p class="alert alert-danger" style="margin-top: 5px;">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                    placeholder="Enter Title..." value="{{old('designation')}}">
                                @error('designation')
                                <p class="alert alert-danger" style="margin-top: 5px;">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="note">Note</label>
                                <input type="text" class="form-control" id="note" name="note"
                                    placeholder="Enter Title..." value="{{old('note')}}">
                                @error('note')
                                <p class="alert alert-danger" style="margin-top: 5px;">{{$message}}</p>
                                @enderror
                            </div>

                            
                            <div class="form-group">
                                <label for="message">Description</label>
                                @error('description')
                                <p class="alert alert-danger" style="margin-top: 5px;">{{$message}}</p>
                                @enderror
                            <textarea style="height: 150px; width: 500px" class="textarea" placeholder="Place Service Description here..."
                                    name="description">{{old('description')}}</textarea>

                            </div>

                            <div class="form-group">
                                <label for="image">Upload Your Image</label>
                                
                                <input type="file" name="image" id="image" class="form-control-file"  placeholder="Enter image name..." value="{{old('image')}}" onchange="previewFile(this);" required>
                            </p>
                            <img style="width:100px;" id="previewImg" src="">
                            <p>

                                @error('image')
                                <p class="alert alert-danger" style="margin-top: 5px;">{{$message}}</p>
                                @enderror
                        
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                    </form>
                </div>


            </div>

        </div>
    </div>
</section>

@endsection
<!-- /.content-wrapper -->
@section('script')
<script>
        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
</script>
@endsection
