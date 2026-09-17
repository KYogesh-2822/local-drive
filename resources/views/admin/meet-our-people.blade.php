@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Meet our people</h3>
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
            <form action="{{route('admin.meet.addContent')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="">Heading</label>
                    <textarea class="form-control summernote" name="heading" id="heading" rows="5">{{$data->heading}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Left content</label>
                    <textarea class="form-control summernote" name="content" id="content" rows="5">{{$data->content}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">Right content</label>
                    <textarea class="form-control summernote" name="content_right" id="content_right" rows="5">{{$data->content_right}}</textarea>
                </div>

                <div class="mb-3">
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
                    @foreach($data_cards as $card)
                    <tr>
                        <td style="width:20%"><img src="{{asset('images/')}}/{{$card->image}}" alt="" ></td>
                        <td>{!! $card->detail !!}</td>
                        <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSlider{{$card->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editSlider{{$card->id}}" tabindex="-1" aria-labelledby="editSliderLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSliderLabel">Edit card</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('admin.meet.editslider')}}" method="post" enctype="multipart/form-data">
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
            </table>
        </div>
        <div class="card mt-4 p-4">
            <form action="{{route('admin.meet.editCulture')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="culture_heading" class="form-label">Heading</label>
                    <input type="text" class="form-control" id="culture_heading" name="culture_heading" value="{{$data->culture_heading}}">
                </div>
                <div class="mb-3">
                    <label for="culture_content" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="culture_content" name="culture_content" rows="3">{{$data->culture_content}}</textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <div class="card mt-4 p-4">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_review as $review)
                    <tr>
                        <td style="width:20%"><img src="{{asset('images/')}}/{{$review->image}}" alt="" style="width:50%"></td>
                        <td>{{ $review->name }}</td>
                        <td>{{ $review->detail }}</td>
                        <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editReview{{$review->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="editReview{{$review->id}}" tabindex="-1" aria-labelledby="editReviewLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editReviewLabel">Edit card</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('admin.meet.editReview')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$review->id}}" name="id">
                                <div class="modal-body">    
                                    <div class="mb-3">
                                        <label for="review_name" class="form-label">Heading</label>
                                        <input type="text" class="form-control" id="review_name" name="review_name" value="{{$review->name}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="review_link" class="form-label">Link</label>
                                        <input type="text" class="form-control" id="review_link" name="review_link" value="{{$review->video}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="review_image" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="review_image" name="review_image" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Description</label>
                                        <textarea class="form-control" id="detail" rows="3" name="detail">{{$review->detail}}</textarea>
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
                        <th>Detail</th>
                        <th>Button Text</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_card as $card)
                    <tr>
                        <td style="width:20%"><img src="{{asset('images/')}}/{{$card->image}}" alt="" style="width:50%"></td>
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
                            <form action="{{route('admin.meet.editCard')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$card->id}}" name="id">
                                <div class="modal-body">    
                                 
                                    <div class="mb-3">
                                        <label for="card_image" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="card_image" name="card_image" value="{{$card->image}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="card_detail" class="form-label">Detail</label>
                                        <textarea class="form-control summernote" id="card_detail" rows="3" name="card_detail">{{$card->detail}}</textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="card_button" class="form-label">Button</label>
                                        <input type="text" class="form-control" id="card_button" name="card_button" value="{{$card->button}}">
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
            <form action="{{route('admin.meet.editRoadSuccess')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="road_heading" class="form-label">Heading</label>
                    <input type="text" class="form-control" id="road_heading" name="road_heading" value="{{$data->road_heading}}">
                </div>
                <div class="mb-3">
                    <label for="road_content" class="form-label">Content</label>
                    <textarea class="form-control summernote" id="road_content" name="road_content" rows="3">{{$data->road_content}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="road_button" class="form-label">Button Text</label>
                    <input type="text" class="form-control" id="road_button" name="road_button" value="{{$data->road_button}}">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
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

</script>
@endsection
