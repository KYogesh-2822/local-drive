@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Travel Advisor/Administrator</h3>
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
</section>
<ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="advisor-tab" data-bs-toggle="tab" data-bs-target="#advisor" type="button" role="tab" aria-controls="advisor" aria-selected="true">Travel Advisor</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">Travel Administrator</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="advisor" role="tabpanel" aria-labelledby="advisor-tab">
         <div class="card my-4 p-4">
             <form action="{{route('admin.travel.AdvisorContent')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="banner_content" class="form-label">Banner Content</label>
                    <textarea class="form-control summernote" id="banner_content" rows="3" name="banner_content">{{$data->advisor_banner}}</textarea>
                </div>
                <div class="mb-3">
                   <button class="btn btn-primary" type="submit">Save</button>
                </div>
             </form>
         </div>
         <div class="card my-4 p-4">
            <form action="{{route('admin.travel.AdvisorPledge')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="pledge_detail" class="form-label">Pledge Content</label>
                    <textarea class="form-control summernote" id="pledge_detail" name="pledge_detail" rows="3">{{$data->pledge_detail}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="pledge_button" class="form-label">Pledge Button</label>
                    <input class="form-control" type="text" id="pledge_button" name="pledge_button" value="{{$data->pledge_button}}">
                </div>
                <div class="mb-3">
                    <label for="pledge_image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="pledge_image" name="pledge_image" >
                </div>
                @if($data->pledge_image != '')
                <img src="{{asset('images/')}}/{{$data->pledge_image}}" alt="" style="width:20%">
                @endif
                <div class="mb-3 mt-2">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>
         <div class="card my-4 p-4">
             <form action="{{route('admin.travel.AdvisorPolicy')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="policy_content" class="form-label">Policy Content</label>
                    <textarea class="form-control summernote" id="policy_content" rows="3" name="policy_content">{{$data->policy_content}}</textarea>
                </div>
                <div class="mb-3">
                   <button class="btn btn-primary" type="submit">Save</button>
                </div>
             </form>
         </div>
         <div class="card my-4 p-4">
            <form action="{{route('admin.travel.GuideHeading')}}" method="post">
              @csrf
                <div class="row">
                    <div class="col">
                    <input class="form-control" type="text" id="guide_heading" name="guide_heading" value="{{$data->guide_heading}}">
                    </div>
                    <div class="col">
                    <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Heading</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guides as $guide)
                    <tr>
                        <td >{{$guide->heading}}</td>
                        <td>{{$guide->link}}</td>
                        <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editGuide{{$guide->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editGuide{{$guide->id}}" tabindex="-1" aria-labelledby="editGuideLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editGuideLabel">Edit Guide</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('admin.travel.AdvisorGuide')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$guide->id}}" name="id">
                                <div class="modal-body">    
                                    <div class="mb-3">
                                        <label for="heading" class="form-label">Heading</label>
                                        <input class="form-control" type="text" id="heading" name="heading" value="{{$guide->heading}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link</label>
                                        <input type="text" class="form-control" name="link" id="link" value="{{$guide->link}}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
    <div class="tab-pane fade " id="admin" role="tabpanel" aria-labelledby="admin-tab"> 
        <div class="card my-4 p-4">
            <form action="{{route('admin.travel.addTrevalAdmin')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="heading" class="form-label">HEADING</label>
                    <textarea class="form-control summernote" id="heading" rows="3" name="heading">{{$data->admin_heading}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="heading" class="form-label">HEADING</label>
                    <input type="text" class="form-control" name="button" id="button" value="{{$data->admin_button}}">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

            
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });
</script>
@endsection
