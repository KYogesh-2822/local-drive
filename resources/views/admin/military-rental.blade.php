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
</section>

<div class="card my-4 p-4">
    <form action="{{route('admin.military.militaryBanner')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="heading" class="form-label">Heading</label>
            <input type="text" class="form-control" id="heading" name="heading" value="{{$data->heading}}">
        </div>
        <div class="mb-3">
            <label for="banner_line" class="form-label">Banner Line</label>
            <textarea class="form-control summernote" id="banner_line"  name="banner_line" rows="1">{{$data->banner_line}}</textarea>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>
<div class="card my-4 p-4">
    <form action="{{route('admin.military.militaryServeContent')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="serve_content" class="form-label">Serve Content</label>
            <textarea class="form-control summernote" id="serve_content"  name="serve_content" rows="1">{{$data->serve_content}}</textarea>
        </div>
        <div class="mb-3">
            <label for="video_link" class="form-label">Video Link</label>
            <input class="form-control" type="text" id="video_link" name="video_link" value="{{$data->video_link}}">
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>
<div class="card my-4 p-4">
    <form action="{{route('admin.military.militaryDiscountContent')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="discount_content" class="form-label">Discount Content</label>
            <textarea class="form-control summernote" id="discount_content"  name="discount_content" rows="3">{{$data->discount_content}}</textarea>
        </div>
        <div class="mb-3">
          <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>

            
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });

</script>
@endsection
