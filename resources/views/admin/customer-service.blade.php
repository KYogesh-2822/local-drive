@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Customer Service</h3>
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
                <button class="nav-link active" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true">Faq's & Help</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="site-tab" data-bs-toggle="tab" data-bs-target="#site" type="button" role="tab" aria-controls="site" aria-selected="true">Site Map</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                <div class="card p-3 mt-4">
                    <h5 class="mb-2">FAQ</h5>
                    <form action="{{route('admin.service.serviceHeadFaq')}}" method="post">
                    @csrf
                        <div class="mb-3">
                            <label for="faq_heading" class="form-label">Faq Heading</label>
                            <input type="text" class="form-control" id="faq_heading" name="faq_heading" value="{{$faq->heading ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label for="faq_sub_footer" class="form-label">faq Footer</label>
                            <textarea class="form-control ckeditor" id="faq_sub_footer" rows="1" name="faq_sub_footer">{{$faq->sub_heading ?? ''}}</textarea>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <div class="card p-3 mt-4">
                    <h5 class="mb-2">FAQ</h5>
                    <form action="{{route('admin.service.serviceHeadFaq')}}" method="post">
                    @csrf
                        <div class="mb-3">
                            <label for="faq_heading" class="form-label">Faq Heading</label>
                            <input type="text" class="form-control" id="faq_heading" name="faq_heading" value="{{$faq->heading ?? ''}}">
                        </div>
                        <div class="mb-3">
                            <label for="faq_sub_footer" class="form-label">faq Footer</label>
                            <textarea class="form-control ckeditor" id="faq_sub_footer" rows="1" name="faq_sub_footer">{{$faq->sub_heading ?? ''}}</textarea>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane fade " id="site" role="tabpanel" aria-labelledby="site-tab"> 
                    <div class="card m-3 p-4">
                        <h6>Heading</h6>
                        <table id="" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Heading</th>
                                    <th style="width:40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($site_heading as $site)
                                <tr>
                                    <td>{{$site->heading}}</td>
                                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#site{{$site->id}}">Edit</a></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="site{{$site->id}}" tabindex="-1" aria-labelledby="siteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="siteLabel">Edit Heading</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{route('admin.service.serviceSideHeading')}}" method="post" >
                                        @csrf
                                        <input type="hidden" value="{{$site->id}}" name="site_id">
                                        <div class="modal-body">    
                                            <div class="mb-3">
                                                <label for="HEADING" class="form-label">Heading</label>
                                                <input type="text" class="form-control" id="heading" name="heading" value="{{$site->heading}}">
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

                    <div class="card m-3 p-4">
                        <h6>Subheading</h6>
                        <form action="" method="post">
                            <h6>Select Main Topic</h6>
                            <select class="form-select" aria-label="Default select example" id="mainHeading">
                                <option>Select</option>
                                @foreach($site_heading as $heading)
                                <option value="{{$heading->id}}" >{{$heading->heading}}</option>
                                @endforeach
                            </select> 
                            <h6 class="my-4">Question/Answer</h6>
                            <div class="card  p-4">
                                <table id="" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sub Heading</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="heading_data">
                                    
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                    <div class="card m-3 p-4">
                        <h6>Detail</h6>
                        <form action="">
                            <select class="form-select" id="mainHeading1" name="mainHeading1" required>
                                <option value="">Select Topic heading</option>
                                @foreach($site_heading as $heading)
                                  <option value="{{$heading->id}}">{{$heading->heading}}</option>
                                @endforeach
                            </select>
                            <div class="mt-4">
                                <select class="form-select" id="mainHeading2" name="mainHeading2" requireed>
                                  <option value="">Select Subheading</option>
                                </select>
                            </div>

                            <div class="card mt-4 p-4">
                                <table id="" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Detail</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_data">
                                    
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- model -->
<div class="modal fade" id="edit_heading_data" tabindex="-1" aria-labelledby="edit_question" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit_question">Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('admin.service.singleHeadingedit')}}" method="post" >
            @csrf
            <div id="single_heading_data">
            <input type="hidden" id="site_id" value="" name="site_id">
            <input type="hidden" id="site_subheading_id" value="" name="site_subheading_id">
              <div class="modal-body">    
                  <div class="mb-3">
                      <label for="question" class="form-label">Heading</label>
                      <input type="text" class="form-control" id="site_subheading" name="site_subheading" value="">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div> 
<!-- model -->
<div class="modal fade" id="edit_detail_data" tabindex="-1" aria-labelledby="edit_question" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit_question">Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('admin.service.detailUpdate')}}" method="post" >
            @csrf
            <div id="single_detail_data">
            <input type="hidden" id="detail_id" value="" name="detail_id">
            <input type="hidden" id="site_detail_id" value="" name="site_detail_id">
              <div class="modal-body">    
                  <div class="mb-3">
                      <label for="question" class="form-label">Detail</label>
                      <input type="text" class="form-control" id="site_detail" name="site_detail" value="">
                  </div>
              </div>
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
    window.onload = function() {
        CKEDITOR.replace('.ckeditor');
    };

$('#mainHeading').change(function () {
    let topic = $(this).val(); 
    $.ajax({
        type: "get",
        url: "{{route('admin.service.serviceSideHeadingView')}}",
        data: {
            "heading": topic
        },
        success: function (data) {
           $('#heading_data').html('');
           $.each(data.data, function(i, val){
                $('#heading_data').append(`<tr>
                        <td>${val.heading}</td>
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
      url: "{{route('admin.service.singleHeadingDetail')}}",
      data: {
          "id": $id
      },
      success: function (data) {
        $('#site_id').val($id);
        $('#site_subheading_id').val(data.data.site_id);
        $('#site_subheading').val(data.data.heading);
        $('#edit_heading_data').modal('show');
      }
  });
}

$('#mainHeading1').change(function () {
    let topic = $(this).val(); 
    $.ajax({
        type: "get",
        url: "{{route('admin.service.serviceSideHeadingView')}}",
        data: {
            "heading": topic
        },
        success: function (data) {
           $('#mainHeading2').html('');
           $('#mainHeading2').append(`<option value="">Select</option>`);
           $.each(data.data, function(i, val){
                $('#mainHeading2').append(`  
                    <option value="${val.id}">${val.heading}</option>
                `);
           });  
        }
    });
});

$('#mainHeading2').change(function () {
    let sub = $(this).val(); 
    
    $.ajax({
        type: "get",
        url: "{{route('admin.service.singleDetailView')}}",
        data: {
            "sub_id": sub
        },
        success: function (data) {
            console.log(data);
           $('#detail_data').html('');
           $.each(data.data, function(i, val){
                $('#detail_data').append(`  <tr>
                        <td>${val.detail}</td>
                        <td><a class="btn btn-primary" onclick="editdetailModel(${val.id});">Edit</a></td>
                    </tr> 
                `);
           });  
        }
    });
});

function editdetailModel($id){ 
   $.ajax({
       type: "get",
       url: "{{route('admin.service.detailView')}}",
       data: {
           "id": $id
       },
       success: function (data) {
         $('#detail_id').val($id);
         $('#site_detail_id').val(data.data.subheading_id);
         $('#site_detail').val(data.data.detail);
         $('#edit_detail_data').modal('show');
       }
   });
 }
</script>
@endsection
