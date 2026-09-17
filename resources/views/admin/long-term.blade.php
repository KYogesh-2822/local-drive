@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>One way Car Rental</h3>
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
        <form action="{{route('admin.editLongTermRental')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="banner_heading" class="form-label">Heading</label>
                <textarea class="form-control summernote" id="banner_heading" name="banner_heading" rows="3">{{$data->heading}}</textarea>
            </div>
            <div class="mb-3">
                <label for="banner_image" class="form-label">Banner Image</label>
                <input class="form-control" type="file" id="banner_image" name="banner_image" value="">
            </div>
            @if($data->banner_image != '')
                <img  class="py-2" src="{{asset('images/')}}/{{$data->banner_image}}" alt="">
            @endif
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

    <div class="card mt-4 p-4">
        <form action="{{route('admin.editLongTermCardText')}}" method="post" >
            @csrf
            <div class="mb-3">
                <label for="rate_text" class="form-label">Rate Text</label>
                <textarea class="form-control summernote" id="rate_text" name="rate_text" rows="3">{{$data->rate_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="mileage_text" class="form-label">Mileage Text</label>
                <textarea class="form-control summernote" id="mileage_text" name="mileage_text" rows="3">{{$data->mileage_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="location_text" class="form-label">Location Text</label>
                <textarea class="form-control summernote" id="location_text" name="location_text" rows="3">{{$data->location_text}}</textarea>
            </div>
       
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

    <div class="card mt-4 p-4">
        <form action="{{route('admin.editLongTermPopularText')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="popular_text" class="form-label">Popular Type Text</label>
                <textarea class="form-control summernote" id="popular_text" name="popular_text" rows="3">{{$data->popular_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="popular_button" class="form-label">Popular Type button</label>
                <input type="text" class="form-control" name="popular_button" id="popular_button" value="{{$data->popular_button}}">
            </div>
            <div class="mb-3">
                <label for="popular_images" class="form-label">Popular Type Images</label>
                <input class="form-control" type="file" id="popular_images" name="popular_images[]" value="" Multiple>
            </div>
            @if($data->popular_images != "")
            <?php $images =  explode(",",$data->popular_images)?>
            <div class="row">
                @foreach($images as $key=>$image)
                <div class="col-lg-2">
                    <img src="{{asset('images/')}}/{{$image}}" alt="">
                </div>
                @endforeach
            </div>
            @endif
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

    <div class="card mt-4 p-4">
        <form action="{{route('admin.editLongTermReasonText')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="reason_text" class="form-label">Long Term Reason</label>
                <textarea class="form-control summernote" id="reason_text" name="reason_text" rows="3">{{$data->reason_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="reason_button" class="form-label">Button Text</label>
                <input type="text" class="form-control" id="reason_button" name="reason_button" value="{{$data->reason_button}}">
            </div>
            <div class="mb-3">
                <label for="reason_image" class="form-label">Image</label>
                <input class="form-control" type="file" id="reason_image" name="reason_image" value="">
            </div>
            @if($data->reason_image != "")
               <img src="{{asset('images/')}}/{{$data->reason_image}}" class="py-2" width="500" alt="">
            @endif
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

    <div class="card mt-4 p-4">
        <form action="{{route('admin.editLongTermLeaseRental')}}" method="post" >
            @csrf
            <div class="mb-3">
                <label for="lease_rental" class="form-label">Lease vs. Rental</label>
                <textarea class="form-control summernote" id="lease_rental" name="lease_rental" rows="3">{{$data->lease_rental}}</textarea>
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