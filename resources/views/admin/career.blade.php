@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Career</h3>
    </div>
    @if (Session::has('message'))
        <div class="alert alert-success mt-2">{{ Session::get('message') }} 
        </div>
    @endif
    <div class="custom_success_message">

    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 

    <div class="card my-4 p-4">
         <form action="{{route('admin.career.addContent')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="banner_content" class="form-label">Banner Content</label>
                <textarea class="form-control summernote" id="banner_content" name="banner_content" rows="3">{{$data->banner_content}}</textarea>
            </div>
            <!-- <div class="mb-3">
                <label for="form_content" class="form-label">Form Content</label>
                <textarea class="form-control summernote" id="form_content" name="form_content" rows="3">{{$data->form_content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="mobility_content" class="form-label">Mobility Content</label>
                <textarea class="form-control summernote"  id="mobility_content" name="mobility_content" rows="3">{{$data->mobility_content}}</textarea>
            </div> -->
            <div class="mb-3">
               <button class="btn btn-primary" type="submit">Save</button>
            </div>
         </form>
    </div>
    <!-- <div class="card my-4 p-4">
         <form action="{{route('admin.career.editLogoBanner')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="logo_heading" class="form-label">Heading</label>
                <input type="text" class="form-control" name="logo_heading" id="logo_heading" value="{{$data->logo_heading}}">
            </div>
            <div class="mb-3">
                <label for="logo_text" class="form-label">Content</label>
                <input type="text" class="form-control" id="logo_text" name="logo_text" value="{{$data->logo_text}}">
              
            </div>
            <div class="mb-3">
                <label for="multi_logo" class="form-label">Multiple Logo</label>
                <input class="form-control" type="file" id="multi_logo" name="multi_logo[]" multiple>  
            </div>
            <div class="row">
                <?php $logos = explode(",",$data->multi_logo);
                ?>
              @foreach($logos as $key=>$logo)
                <div class="col-lg-2">
                    <img src="{{asset('images/')}}/{{$logo}}" alt="">
                </div>
              @endforeach 
            </div>
            <div class="mb-3">
               <button class="btn btn-primary" type="submit">Save</button>
            </div>
         </form>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Detail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cards as $card)
            <tr>
                <td style="width:10%"><img src="{{asset('images/')}}/{{$card->image}}" alt="" ></td>
                <td>{!! $card->detail !!}</td>
                <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCard{{$card->id}}">Edit</a></td>
            </tr>
         
            <div class="modal fade" id="editCard{{$card->id}}" tabindex="-1" aria-labelledby="editCardLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCardLabel">Edit catd</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.career.editCard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$card->id}}" name="id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image" >
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <textarea class="form-control summernote" id="detail" rows="3" name="detail">{{$card->detail}}</textarea>
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
    </table> -->
</section>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });
</script>
@endsection