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
        <form action="{{route('admin.Standard.content')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="banner_logo" class="form-label">Banner Logo</label>
                <input class="form-control" type="file" id="banner_logo" name="banner_logo" value="">
            </div>
            @if($data->banner_logo != '')
                <img  class="py-2" src="{{asset('images/')}}/{{$data->banner_logo}}" alt="">
            @endif 
            <div class="mb-3">
                <label for="standard_content" class="form-label">Content</label>
                <textarea class="form-control summernote" id="standard_content" name="standard_content" rows="3">{{$data->content}}</textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card mt-4 p-4">
        <table id="example1" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <td style="width:10%"><img src="{{asset('images/')}}/{{$card->logo}}" alt=""></td>
                    <td>{!! $card->content !!}</td>
                    <td><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#learn{{$card->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="learn{{$card->id}}" tabindex="-1" aria-labelledby="learnLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="learnLabel">Edit learn more section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.Standard.standardCard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$card->id}}" name="id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon</label>
                                <input class="form-control" type="file" id="icon" name="icon" >
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control summernote" id="content" rows="3" name="content">{{$card->content}}</textarea>
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