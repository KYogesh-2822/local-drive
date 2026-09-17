@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Promotion</h3>
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
                <button class="nav-link active" id="deal-tab" data-bs-toggle="tab" data-bs-target="#deal" type="button" role="tab" aria-controls="deal" aria-selected="true">All Deals & Coupons </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="program-tab" data-bs-toggle="tab" data-bs-target="#program" type="button" role="tab" aria-controls="program" aria-selected="true">Partner Rewards Programs</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="deal" role="tabpanel" aria-labelledby="deal-tab">
                <div class="card p-4">
                     <form action="{{route('admin.promotion.add')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{$data->heading ?? ''}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <input type="text" class="form-control" id="message" name="message" value="{{$data->message ?? ''}}" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                     </form>
                </div>
                <div class="card p-4 mt-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image </th>
                                <th>Heading</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cards as $card)
                            <tr>
                                <td> <img src="{{asset('images')}}/{{$card->image}}" alt=""> </td>
                                <td>{{$card->heading}}</td>
                                <td>{{ $card->detail }}</td>
                                <td>  <a data-bs-toggle="modal" data-bs-target="#contactCard{{$card->id}}" class="btn btn-primary">Edit</a></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="contactCard{{$card->id}}" tabindex="-1" aria-labelledby="contactCardLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactCardLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('admin.promotion.updateOffer')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="card_id" value="{{$card->id}}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="card_icon" class="form-label">Icon</label>
                                            <input class="form-control" type="file" id="card_icon" name="card_icon">
                                        </div>
                                        <div class="mb-3">
                                            <label for="card_heading" class="form-label">Heading</label>
                                            <input type="text" class="form-control" id="card_heading" name="card_heading" value="{{$card->heading}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="card_detail" class="form-label">Detail</label>
                                            <textarea class="form-control " id="card_detail" name="card_detail" rows="3">{{$card->detail}}</textarea>
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
            <div class="tab-pane fade " id="program" role="tabpanel" aria-labelledby="program-tab"> 
                <div class="card p-4">
                    <form action="{{route('admin.promotion.program')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control summernote" id="content" name="content" rows="3">{{$program->content ?? ''}}</textarea>
                        </div>
                        <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <div class="card p-4 mt-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Image </th>
                                <th>Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reward_images as $image)
                            <tr>
                                <td> <img src="{{asset('images')}}/{{$image->image}}" alt="" style="width:10%;"> </td>
                                <td>  <a data-bs-toggle="modal" data-bs-target="#rewardProgram{{$image->id}}" class="btn btn-primary">Edit</a></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="rewardProgram{{$image->id}}" tabindex="-1" aria-labelledby="rewardProgramLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rewardProgramLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('admin.promotion.updateImage')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{$image->id}}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Icon</label>
                                            <input class="form-control" type="file" id="image" name="image">
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


</script>
@endsection
