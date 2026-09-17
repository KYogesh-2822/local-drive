@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Jobs</h3>
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
    <div class="">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true">Job Category </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ques-tab" data-bs-toggle="tab" data-bs-target="#ques" type="button" role="tab" aria-controls="ques" aria-selected="true">Job requirement</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="faq" role="tabpanel" aria-labelledby="faq-tab">   
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addjobModal">Add job title</button>
        <div class="card m-3 p-4">
            <table id="" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Profile</th>
                        <th style="width:40%">Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($categories as $cat)
                        <tr>
                            <td>{{$cat->name}}</td>
                            <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#topic{{$cat->id}}">Edit</a>
                            <a onclick="deleteJob({{$cat->id}})" class="btn btn-danger">Delete</a></td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="topic{{$cat->id}}" tabindex="-1" aria-labelledby="topicLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="topicLabel">Category Name</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('admin.job.edit')}}" method="post" >
                                    @csrf
                                    <input type="hidden" value="{{$cat->id}}" name="cat_id">
                                    <div class="modal-body">    
                                        <div class="mb-3">
                                            <label for="topic" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$cat->name}}" required>
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
    </div>
    <div class="tab-pane fade" id="ques" role="tabpanel" aria-labelledby="ques-tab">   
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addreqModal">Add Job requirement</button>
        <div class="card m-3 p-4">
            <form action="" method="post">
                <h6>Select Main Category</h6>
                <select class="form-select" aria-label="Default select example" id="mainCatagory">
                    <option>Select</option>
                    @foreach($categories as $cate)
                       <option value="{{$cate->id}}" >{{$cate->name}}</option>
                    @endforeach
                </select> 
                <h6 class="my-4">Profile requirement</h6>
                <div class="card  p-4">
                    <table id="" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th style="width:40%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="req_data">
                        
                        </tbody>
                    </table>
            </div>
            </form>
        </div>
    </div>


</div>
  
    </div>
</section>
<!-- model -->
<div class="modal fade" id="addjobModal" tabindex="-1" aria-labelledby="addjobModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addjobModalLabel">Add job Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{route('admin.job.addProfile')}}" method="post">
            @csrf
            <div class="modal-body">    
                <div class="mb-3">
                    <label for="topic" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- model -->
<div class="modal fade" id="addreqModal" tabindex="-1" aria-labelledby="addreqModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addreqModalLabel">Requirements</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.job.addReq')}}" method="post">
            @csrf
            <div class="modal-body">    
                <div class="mb-3">
                    <label for="topic" class="form-label">Profile</label>
                    <select class="form-select" aria-label="Default select example" name="category"  required>
                        @foreach($categories as $cate)
                        <option value="{{$cate->id}}" >{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="topic" class="form-label">Profile</label>
                    <input type="text" class="form-control" id="profile" name="profile" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control " id="location" name="location" required>
                </div>
                <div class="mb-3">
                    <label for="discription" class="form-label">Discroption</label>
                    <textarea class="form-control summernote" id="discription" name="discription" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" aria-label="Default select example" name="type" required>
                        <option value="full time">Full Time</option>
                        <option value="part time">Part Time</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--edit model -->
<div class="modal fade" id="edit_question_answer" tabindex="-1" aria-labelledby="edit_question" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit_question">Edit Question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('admin.job.editReq')}}" method="post" >
            @csrf
            <div id="single_job_data">
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div> 



<!-- <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
$(document).ready(function() {
      $('.summernote').summernote();
    });


$('#mainCatagory').change(function () {
    let job_cate = $(this).val(); 
    $.ajax({
        type: "get",
        url: "{{route('admin.job.viewJob')}}",
        data: {
            "job_cate": job_cate
        },
        success: function (data) {
            $('#req_data').html('');
            if(data.data.length > 0){
                $.each(data.data, function(i, val){
                     $('#req_data').append(`<tr>
                             <td>${val.profile}</td>
                             <td>${val.location}</td>
                             <td>${val.type}</td>
                             <td><a class="btn btn-primary" onclick="editModel(${val.id});">Edit</a>
                             <a class="btn btn-danger" onclick="deleteReqModel(${val.id});">Delete</a></td>
                         </tr>   
                     `);
                });  
            }else{
                $('#req_data').append(`<p>Data not found</p>`);
            }
        }
    });
});

function deleteJob(id){
    Swal.fire({
        title: "Are you sure?",
        text: "You would like to delete this post!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            
        if (result.isConfirmed) {
            
            $.ajax({
                url : "{{ route('admin.job.deleteProfile') }}",
                data : {'id':id},
                type : 'GET',
                dataType : 'json',
                success : function(response){
                  if(response == 1){
                    Swal.fire({
                        title: "job category delete successfully!",
                        text: "You clicked the button!",
                        icon: "success"
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            Swal.fire("Saved!", "", "success");
                            location.reload(true);
                        } else if (result.isDenied) {
                            Swal.fire("Changes are not saved", "", "info");
                        }
                    });
                  }
                
                }
            });
        }
    });
      
}
 

function editModel(id){
  $.ajax({
      type: "get",
      url: "{{route('admin.job.viewReq')}}",
      data: {
          "id": id
      },
      success: function (data) {
        console.log(data);
         $('#single_job_data').html('');
         if(data.status == 'success'){
            if(data.data.type == 'full time'){
                var selected = 'selected';
            }else{
                var selected = '';
            }
            if(data.data.type == 'part time'){
                var selected1 = 'selected';
            }else{
                var selected1 = '';
            }
             $('#single_job_data').append(`<input type="hidden" value="${data.data.id}" name="cat_id">
              <div class="modal-body">    
               
                        <div class="mb-3">
                            <label for="topic" class="form-label">Profile</label>
                            <input type="text" class="form-control" id="profile" value="${data.data.profile}" name="profile" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" value="${data.data.location}" name="location" required>
                        </div>
                        <div class="mb-3">
                    <label for="discription" class="form-label">Discription</label>
                    <textarea class="form-control summernote" id="discription" name="discription" rows="3" required>${data.data.discription}</textarea>
                </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" aria-label="Default select example" name="type" required>
                                <option value="full time" ${selected}>Full Time</option>
                                <option value="part time" ${selected1} >Part Time</option>
                            </select>
                        </div>
               
              </div>
             `);
             $(" .summernote").summernote();
             $('#edit_question_answer').modal('show');
         }
      }
  });
}

function deleteReqModel(id){
    Swal.fire({
        title: "Are you sure?",
        text: "You would like to delete this post!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            
        if (result.isConfirmed) {
            
            $.ajax({
                url : "{{ route('admin.job.deleteReq') }}",
                data : {'id':id},
                type : 'GET',
                dataType : 'json',
                success : function(response){
                  if(response == 1){
                    Swal.fire({
                        title: "job category delete successfully!",
                        text: "You clicked the button!",
                        icon: "success"
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            Swal.fire("Saved!", "", "success");
                            location.reload(true);
                        } else if (result.isDenied) {
                            Swal.fire("Changes are not saved", "", "info");
                        }
                    });
                  }
                
                }
            });
        }
    });
}


</script>

@endsection
