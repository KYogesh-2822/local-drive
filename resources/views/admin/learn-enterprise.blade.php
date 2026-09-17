@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Learn More About Enterprise Plus®</h3>
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
        <form action="{{route('admin.learn.addLearnContent')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="heading" class="form-label">Heading</label>
                <textarea class="form-control summernote" id="heading" name="heading" rows="3">{{$data->heading}}</textarea>
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
                <textarea class="form-control summernote" id="center_column" name="center_column" rows="3">{{$data->center_column}}</textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

    <div class="card mt-4 p-4">
        <form action="{{route('admin.learn.addLearnRewardHeading')}}" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" name="reward_point_heading" id="reward_point_heading" value="{{$data->reward_point_heading}}">
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </form>
        <table id="example" class="table table-striped mt-4" style="width:100%">
            <thead>
                <tr>
                    <th>Heading</th>
                    <th>Points</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rewards as $reward)
                <tr>
                    <td> {{$reward->heading}}</td>
                    <td>{!! $reward->points !!}</td>
                    <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editReward{{$reward->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="editReward{{$reward->id}}" tabindex="-1" aria-labelledby="editRewardLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editRewardLabel">Edit Slider</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('admin.learn.addLearnRewardPoint')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$reward->id}}" name="id">
                            <div class="modal-body">    
                                <div class="mb-3">
                                    <label for="heading" class="form-label">Heading</label>
                                    <input class="form-control" type="type" id="heading" name="heading" value="{{$reward->heading}}">
                                </div>
                                <div class="mb-3">
                                    <label for="point" class="form-label">Points</label>
                                    <textarea class="form-control summernote" id="point" rows="3" name="point">{{$reward->points}}</textarea>
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
        <form action="{{route('admin.learn.addLearnreward')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="reward_detail" class="form-label">Detail</label>
                <textarea class="form-control summernote" id="reward_detail" name="reward_detail" rows="3">{{$data->reward_detail}}</textarea>
            </div>
            <div class="mb-3">
                <label for="reward_button" class="form-label">Button Text</label>
                <input class="form-control" type="type" id="reward_button" name="reward_button" value="{{$data->reward_button}}">
            </div>
      
            <div class="mb-3">
                <label for="reward_image" class="form-label">Image</label>
                <input class="form-control" type="file" id="reward_image" name="reward_image" value="">
            </div>
            @if(isset($data->reward_image))
            <img src="{{asset('images/')}}/{{$data->reward_image}}" alt="" style="width:40%">
            @endif
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

    <div class="card mt-4 p-4">
        <form action="{{route('admin.learn.addLearnBenifit')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="benifit_heading" class="form-label">Detail</label>
                <input class="form-control" type="type" id="benifit_heading" name="benifit_heading" value="{{$data->benifit_heading}}">
              
            </div>
            <div class="mb-3">
                <label for="benifit_detail" class="form-label">Button Text</label>
                <textarea class="form-control summernote" id="benifit_detail" name="benifit_detail" rows="3">{{$data->benifit_detail}}</textarea>
            </div>
            <div class="mb-3">
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
</script>
@endsection