@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Navbar</h1>
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
            <button class="nav-link active" id="top-nav-tab" data-bs-toggle="tab" data-bs-target="#top-nav" type="button" role="tab" aria-controls="top-nav" aria-selected="true">Top navbar</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="main-heading-tab" data-bs-toggle="tab" data-bs-target="#main-heading" type="button" role="tab" aria-controls="main-heading" aria-selected="true">Main Heading</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="sub-heading-tab" data-bs-toggle="tab" data-bs-target="#sub-heading" type="button" role="tab" aria-controls="sub-heading" aria-selected="true">Sub Headings</button>
        </li>
    </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="top-nav" role="tabpanel" aria-labelledby="top-nav-tab">
    <div class="card m-3 p-4">
        <table id="" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Heading</th>
                    <th style="width:40%">Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($top_nav as $top)
                <tr>
                    <td>{{$top->heading}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#top{{$top->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="top{{$top->id}}" tabindex="-1" aria-labelledby="topLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="topLabel">Edit heading</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.nav.topNav')}}" method="post" >
                        @csrf
                        <input type="hidden" value="{{$top->id}}" name="top_id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="top_heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="top_heading" name="top_heading" value="{{$top->heading}}">
                            </div>
                            @if($top->id == '1')
                            <div class="mb-3">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" class="form-control" id="link" name="link" value="{{$top->link}}">
                            </div>
                            @endif
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
  <div class="tab-pane fade  " id="main-heading" role="tabpanel" aria-labelledby="main-heading-tab">
    <div class="card m-3 p-4">
        <table id="" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Heading</th>
                    <th style="width:40%">Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($main_headings as $main)
                <tr>
                    <td>{{$main->heading}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#main{{$main->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="main{{$main->id}}" tabindex="-1" aria-labelledby="mainLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mainLabel">Edit heading</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.nav.editNav')}}" method="post" >
                        @csrf
                        <input type="hidden" value="{{$main->id}}" name="main_id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="main_heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="main_heading" name="main_heading" value="{{$main->heading}}">
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
  <div class="tab-pane fade " id="sub-heading" role="tabpanel" aria-labelledby="sub-heading-tab"> 
     <div class="card m-3 p-4">
        <form action="" method="post">
            <h6>Select Main Heading</h6>
            <select class="form-select" aria-label="Default select example" id="mainHeading">
                <option>Select</option>
                @foreach($main_headings as $heading)
                   <option value="{{$heading->id}}" >{{$heading->heading}}</option>
                @endforeach
            </select> 
            <h6 class="my-4">Sub Heading</h6>
            <div class="card  p-4">
                <table id="" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sub heading</th>
                            <th>Status</th>
                            <th style="width:40%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sub_heading_data">
                      
                    
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
<div class="modal fade" id="edit_sub_heading" tabindex="-1" aria-labelledby="sub_headingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="sub_headingLabel">Edit heading</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('admin.nav.updateSubHeading')}}" method="post" >
            @csrf
            <div id="single_sub_heading_data">
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div> 

<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
$('#mainHeading').change(function () {
    let main_id = $(this).val(); 
    $.ajax({
        type: "get",
        url: "{{route('admin.nav.subHeadingView')}}",
        data: {
            "main_id": main_id
        },
        success: function (data) {
            console.log(data);
           $('#sub_heading_data').html('');
            $.each(data.sub_heading, function(i, val){
                if(val.status == 1){
                    var status = 'Enable';
                }else{
                    var status = 'Disable'
                }
                $('#sub_heading_data').append(`<tr>
                        <td>${val.sub_heading}</td>
                        <td>${status}</td>
                        <td><a class="btn btn-primary" onclick="editModel(${val.id});">Edit</a></td>
                    </tr>   
                `);
           });  
        }
    });
});
 
 function editModel($id){
  
    $.ajax({
        type: "get",
        url: "{{route('admin.nav.singleHeadingView')}}",
        data: {
            "id": $id
        },
        success: function (data) {
           $('#single_sub_heading_data').html('');
           if(data.status == 'success'){
               if(data.sub_heading.nav_id == 10){
                      var link = ` <div class="mb-3">
                        <label for="sub_link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="sub_link" name="sub_link" value="${data.sub_heading.link}">
                        </div>`;
                     }
               $('#single_sub_heading_data').append(`<input type="hidden" value="${data.sub_heading.id}" name="sub_heading_id">
                <div class="modal-body">    
                    <div class="mb-3">
                        <label for="sub_heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="${data.sub_heading.sub_heading}">
                    </div>
                    ${link}
                    <lable>Status</lable>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="1"  >Enable</option>
                        <option value="2"  >disable</option>
                    </select>
                </div>
               `);
               $('#edit_sub_heading').modal('show');
           }
        }
    });
 }
</script>
@endsection
