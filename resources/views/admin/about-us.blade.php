@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>About us</h3>
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

<div class="card mt-4 p-4">
   <form action="{{route('admin.about.editAboutContent')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="heading" class="form-label">Heading</label>
            <textarea class="form-control summernote" id="heading" name="heading" rows="3">{{$data->heading ?? ''}}</textarea>
        </div>
        <div class="mb-3">
            <label for="left_column" class="form-label">Left Column</label>
            <input class="form-control" type="file" id="left_column" name="left_column" value="">
        </div>
        @if(isset($data->left_column))
        <img src="{{asset('images/')}}/{{$data->left_column}}" alt="" style="width:10%">
        @endif
        <div class="mb-3">
            <label for="center_column" class="form-label">Center Column</label>
            <textarea class="form-control summernote" id="center_column" name="center_column" rows="3">{{$data->center_column ?? ''}}</textarea>
        </div>
        <div class="mb-3">
            <label for="right_column" class="form-label">Right Column</label>
            <textarea class="form-control summernote" id="right_column" name="right_column" rows="3">{{$data->right_column ?? ''}}</textarea>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
   </form>
</div>

<div class="card mt-4 p-4">
     <form action="{{route('admin.about.editAboutmultiImage')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <label for="multi_images" class="form-label">Multiple Images</label>
            <div class="col">
                <input class="form-control" type="file" id="multi_images" name="multi_images[]" multiple>
            </div>
            <div class="col">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
     </form>
     <div class="row mt-4" id="multipleImages">
        @foreach($images as $image)
        <div class="col-lg-3 " >
            <div class="grid" >
                <figure>
                    <button type="button" class="btn-close" aria-label="Close" onclick="deleteImage({{$image->id}});"></button>
                    <img src="{{asset('images/')}}/{{$image->image}}" alt="img">
                </figure>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="card mt-4 p-4">
   <form action="{{route('admin.about.editAboutValue')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="value_heading" class="form-label">Heading</label>
            <input type="text"  class="form-control" id="value_heading" name="value_heading" value="{{$data->value_heading}}">
        </div>
        <div class="mb-3">
            <label for="value_content" class="form-label">Content</label>
            <textarea class="form-control summernote" id="value_content" name="value_content" rows="3">{{$data->value_content}}</textarea>
        </div>
        <div class="mb-3">
            <label for="value_image" class="form-label">Image</label>
            <input class="form-control" type="file" id="value_image" name="value_image" value="">
        </div>
        @if($data->value_image != '')
        <img src="{{asset('images/')}}/{{$data->value_image}}" alt="" style="width:20%">
        @endif
        <div class="mb-3 mt-2">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
   </form>
</div>

<div class="card mt-4 p-4">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Detail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td style="width:10%"><img src="{{asset('images/')}}/{{$slider->image}}" alt="" ></td>
                <td>{!! $slider->content !!}</td>
                <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSlider{{$slider->id}}">Edit</a></td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="editSlider{{$slider->id}}" tabindex="-1" aria-labelledby="editSliderLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSliderLabel">Edit Slider</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.about.editAboutSlider')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$slider->id}}" name="id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image" >
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <textarea class="form-control summernote" id="detail" rows="3" name="detail">{{$slider->content}}</textarea>
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

<div class="card mt-4 p-4">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Heading</th>
                <th>Detail</th>
                <th>Button Text</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cards as $card)
            <tr>
                <td style="width:10%"><img src="{{asset('images/')}}/{{$card->image}}" alt="" ></td>
                <td>{{ $card->heading }}</td>
                <td>{!! $card->detail !!}</td>
                <td>{{ $card->button }}</td>
                <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCard{{$card->id}}">Edit</a></td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="editCard{{$card->id}}" tabindex="-1" aria-labelledby="editCardLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCardLabel">Edit card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.about.editAboutCards')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$card->id}}" name="id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="heading" class="form-label">Heading</label>
                                <input class="form-control" type="text" id="heading" name="heading" value="{{$card->heading}}">
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <textarea class="form-control " id="detail" rows="3" name="detail">{{$card->detail}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Button Text</label>
                                <input class="form-control" type="text" id="detail"  name="button" value="{{$card->button}}">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image" >
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

<div class="card mt-4 p-4">
   <form action="{{route('admin.about.editAboutBanner')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="banner_content" class="form-label">Banner Content</label>
            <textarea class="form-control summernote" id="banner_content" name="banner_content" rows="3">{{$data->banner_content}}</textarea>
        </div>
        <div class="mb-3">
            <label for="banner_button" class="form-label">Banner Button Text</label>
            <input type="text"  class="form-control" id="banner_button" name="banner_button" value="{{$data->banner_button}}">
        </div>
        <div class="mb-3">
            <label for="banner_image" class="form-label">Banner Image</label>
            <input class="form-control" type="file" id="banner_image" name="banner_image" >
        </div>
        @if($data->banner_image != '')
        <img src="{{asset('images/')}}/{{$data->banner_image}}" alt="">
        @endif
        <div class="mb-3 mt-2">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
   </form>
</div>
</section>

            
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });

   function deleteImage($id){
    $.ajax({
        url: "{{route('admin.about.deleteAboutMultiImage')}}",
        data: {
            'id':$id
        },
        type: 'get',
        success: function (response) {
           console.log(response);
           if(response.status == 'success'){
             $('.custom_success_message').html('');
             $("#multipleImages").load(location.href + " #multipleImages>*", "");
             $('.custom_success_message').append(` <div class="alert alert-success mt-2"> ${response.message} </div>`);
           }
        }
    });
   }
</script>
@endsection