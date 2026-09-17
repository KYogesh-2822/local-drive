@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Business Rental Form</h3>
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
        <div class="card p-4">
           <h6>Banner Section</h6>
            <form action="{{route('admin.retailFormSave')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="banner_text" class="form-label">Banner Text</label>
                    <textarea class="form-control summernote" id="banner_text" rows="3" name="banner_text">{{$data->business_form_content}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name="image" value="">
                </div>
                <img src="{{asset('images/')}}/{{$data->business_form_image}}" alt="">
                <div class="mb-3">
                   <button type="submit" class="btn btn-primary">Save</button>
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
 
</script>
@endsection
