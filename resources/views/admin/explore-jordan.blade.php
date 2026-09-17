@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Explore Jordan</h3>
    </div>
    @if (Session::has('message'))
        <div class="alert alert-success mt-2">{{ Session::get('message') }} 
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="custom_success_message"></div>
    <div class="">
         <div class="card my-4 p-4">
            <form action="{{route('admin.inspiration.jordanBanner')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="banner_content" class="form-label">logo</label>
                    <input type="file" class="form-control"  name="logo" value="">
                </div>
                @if($data->logo != '')
                <img src="{{asset('/images/')}}/{{$data->logo}}" alt="">
                @endif
                <div class="mb-3">
                    <label for="banner_content" class="form-label">line</label>
                    <input type="text" class="form-control"  name="logo_line" value="{{$data->banner_line ?? ''}}">
                </div>
                <div class="mb-3">
                    <label for="banner_content" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="banner_content" name="banner_content" rows="3">{{$data->banner_text ?? ''}}</textarea>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>

    </div>
    <div class="">
         <div class="card my-4 p-4">
            <form action="{{route('admin.inspiration.jordanPeople')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="heading" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="heading" name="heading" rows="3">{{$data->people_heading ?? ''}}</textarea>
                </div>
             
           
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>

    </div>
    <div class="card my-4 p-4">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVechile">Add</button>
    <table class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
            <tr>
                <td><img src="{{asset('/images')}}/{{$image->image}}" alt="" style="width:5rem;"></td>
                <td class="text-capitalize">{{$image->name}}</td>

                <td><button class="btn-primary" data-bs-toggle="modal" data-bs-target="#editVechile{{$image->id}}">Edit</button>
                <button class="btn-danger" onclick="deleteImage({{$image->id}})">Delete</button></td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="editVechile{{$image->id}}" tabindex="-1" aria-labelledby="editVechileLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editVechileLabel">Edit attractions Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.inspiration.editJordanImage')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$image->id}}" name="id"> 
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" value="{{$image->image ?? ''}}" >
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$image->name ?? ''}}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            @endforeach

     
          
        </tbody>
 
    </table>

    </div>
</section>
 <!-- Modal -->
 <div class="modal fade" id="addVechile" tabindex="-1" aria-labelledby="addVechileLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVechileLabel">Attractions Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.inspiration.jordanImage')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image"  required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"  required>
                            </div>
                         
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
<style>
    
.container .btn {
  position: absolute;
  top: 15%;
  right: 0%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #555;
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

</style>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>

    $(document).ready(function() {
      $('.summernote').summernote();
    });
   function deleteImage(id){

    Swal.fire({
                title: "Are you sure?",
                text: "You would like to delete this policy!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                 
                if (result.isConfirmed) {
                   
                    $.ajax({
                        url : "{{route('admin.inspiration.deleteJordanImage')}}",
                        data : {'id':id},
                        type : 'GET',
                        dataType : 'json',
                        success : function(response){
                         console.log(response);
                           $('.custom_success_message').html('');
                            if(response == 1){
                                $('.custom_success_message').append(` <div class="alert alert-success mt-2">Policy deleted succesfully. </div>`)
                                location.reload();
                            }   
                            
                        }
                    });
                }
            });
   }
</script>
@endsection
