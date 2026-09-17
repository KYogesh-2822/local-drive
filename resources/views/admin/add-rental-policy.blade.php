@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Add Rental Policies</h3>
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
    <a href="{{route('admin.policy.index')}}"><i class="fa fa-arrow-left"></i> Back</a>
    <form action="{{route('admin.policy.policy')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="heading">Heading</label>
            <input type="text" class="form-control" id="heading" name="heading" required>
        </div>
        <div class="form-group">
            <label for="detail">Detail</label>
            <textarea class="form-control summernote" name="detail" id="detail" rows="3" required></textarea>
        </div>
        <button class="btn btn-primary my-4" type="submit">Save</button>
    </form>


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