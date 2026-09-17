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
    <div class="">
         <div class="card my-4 p-4">
            <form action="{{route('admin.inspiration.BannerContent')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="banner_content" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="banner_content" name="banner_content" rows="3">{{$data->banner_content}}</textarea>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>
         <div class="card mt-4 p-4">
            <form action="{{route('admin.inspiration.planningContent')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="planning_content" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="planning_content" name="planning_content" rows="3">{{$data->planning_detail}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="planning_button" class="form-label">Button</label>
                    <input type="text" class="form-control" id="planning_button" name="planning_button" value="{{$data->planning_button}}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input  accept="image/*" class="form-control" type="file" id="imgInp" name="planning_image" >
                </div>

                <img id="blah" src="{{asset('images')}}/{{$data->planning_image}}" style="width:50%"/>
                <div class="mb-3 mt-2">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>
         <div class="card mt-4 p-4">
            <form action="{{route('admin.inspiration.destinationContent')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="destination_content" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="destination_content" name="destination_content" rows="3">{{$data->destination_detail}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="destination_button" class="form-label">Button</label>
                    <input type="text" class="form-control" id="destination_button" name="destination_button" value="{{$data->destination_button}}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input  accept="image/*" class="form-control" type="file" id="imgInp1" name="destination_image">
                </div>

                <img id="blah1" src="{{asset('images')}}/{{$data->destination_image}}" style="width:50%"/>
                <div class="mb-3 mt-2">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>
         <div class="card mt-4 p-4">
            <form action="{{route('admin.inspiration.bestTripContent')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="best_trip_content" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="best_trip_content" name="best_trip_content" rows="3">{{$data->best_trip_detail}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="best_trip_button" class="form-label">Button</label>
                    <input type="text" class="form-control" id="best_trip_button" name="best_trip_button" value="{{$data->best_trip_button}}">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input  accept="image/*" class="form-control" type="file" id="imgInp2" name="best_trip_image">
                </div>

                <img id="blah2" src="{{asset('images')}}/{{$data->best_trip_image}}" style="width:50%"/>
                <div class="mb-3 mt-2">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>
         <div class="card mt-4 p-4">
            <form action="{{route('admin.inspiration.featureHeading')}}" method="post">
              @csrf
              <div class="row g-3">
                <div class="col">
                    <input type="text" class="form-control" name="feature_heading" id="feature_heading" value="{{$data->feature_heading}}">
                </div>
                <div class="col">
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
                        <td><img src="{{asset('images/')}}/{{$card->image}}" alt="" style="width:50%"></td>
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
                            <form action="{{route('admin.inspiration.editFeatureCard')}}" method="post" enctype="multipart/form-data">
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
         <div class="card mt-4 p-4">
            <form action="{{route('admin.inspiration.editFaqMessage')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="faq_message" class="form-label">Message Content</label>
                    <textarea class="form-control summernote" id="faq_message" name="faq_message" rows="3">{{$data->faq_message}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="faq_button" class="form-label">Button</label>
                    <input type="text" class="form-control" name="faq_button" id="faq_button" value="{{$data->faq_button}}">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
         </div>
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
    imgInp1.onchange = evt => {
        const [file] = imgInp1.files
        if (file) {
            blah1.src = URL.createObjectURL(file)
        }
    }
    imgInp2.onchange = evt => {
        const [file] = imgInp2.files
        if (file) {
            blah2.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
