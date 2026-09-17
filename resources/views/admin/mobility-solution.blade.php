@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Road Trip Ideas</h3>
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
        <div class="card mt-4 p-4">
            <form action="{{route('admin.mobility.mobilityBannerImage')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="imgInp" class="form-label">Banner Image</label>
                    <input  accept="image/*" class="form-control" type="file" id="imgInp" name="banner_image" >
                </div>
                <img id="blah" src="{{asset('images')}}/{{$data->image}}" style="width:50%"/>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>  
        <div class="card mt-4 p-4">
            <form action="{{route('admin.mobility.mobilityContent')}}" method="post">
              @csrf
              <div class="">
                <div class="col">
                    <textarea class="form-control summernote" name="mobility_content" id="mobility-content" rows="5">{!! $data->content !!}</textarea>
                </div>
                <div class="col my-4">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
              </div>
            </form>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Detail</th>
                        <th>Button</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cards as $card)
                    <tr>
                        <td style="width:10%"><img src="{{asset('images/')}}/{{$card->image}}" alt="" ></td>
                        <td>{!! $card->detail !!}</td>
                        <td>{{$card->button}}</td>
                        <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editFeature{{$card->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editFeature{{$card->id}}" tabindex="-1" aria-labelledby="editFeatureLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFeatureLabel">Edit card</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('admin.mobility.addMobilityCard')}}" method="post" enctype="multipart/form-data">
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
                                    <div class="mb-3">
                                        <label for="button" class="form-label">Button</label>
                                        <input type="text" class="form-control" id="button" name="button" value="{{$card->button}}">
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
</section>

            
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
