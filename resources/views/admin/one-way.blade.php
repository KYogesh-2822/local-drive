@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Long term car rental</h3>
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
        <form action="{{route('admin.editOneWayRental')}}" method="post" >
            @csrf
            <div class="mb-3">
                <label for="mileage_text" class="form-label">Mileage Text</label>
                <textarea class="form-control summernote" id="mileage_text" name="mileage_text" rows="3">{{$data->mileage_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="location_text" class="form-label">Location Text</label>
                <textarea class="form-control summernote" id="location_text" name="location_text" rows="3">{{$data->location_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="time_text" class="form-label">Time Text</label>
                <textarea class="form-control summernote" id="time_text" name="time_text" rows="3">{{$data->time_text}}</textarea>
            </div>
       
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card mt-4 p-4">
        <form action="{{route('admin.editOneWayRentalType')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="type_text" class="form-label">Type Text</label>
                <textarea class="form-control summernote" id="type_text" name="type_text" rows="3">{{$data->type_text}}</textarea>
            </div>

            <div class="mb-3">
                <label for="car_type_image" class="form-label">Car Type Images</label>
                <input class="form-control" type="file" id="car_type_image" name="car_type_image[]" value="" Multiple>
            </div>
            @if($data->car_type_image != "")
            <?php $images =  explode(",",$data->car_type_image)?>
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
        <form action="{{route('admin.editOneWayRentalmileage')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="full_mileage_text" class="form-label">Mileage Car</label>
                <textarea class="form-control summernote" id="full_mileage_text" name="full_mileage_text" rows="3">{{$data->full_mileage_text}}</textarea>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card mt-4 p-4">
        <form action="{{route('admin.editOneWayRentalLooking')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="looking_trip_text" class="form-label">Looking Trip</label>
                <textarea class="form-control summernote" id="looking_trip_text" name="looking_trip_text" rows="3">{{$data->looking_trip_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="looking_image" class="form-label">Image</label>
                <input class="form-control" type="file" id="looking_image" name="looking_image" value="">
            </div>
            @if($data->looking_image != "")
               <img src="{{asset('images/')}}/{{$data->looking_image}}" class="py-2" width="500" alt="">
            @endif
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