@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h5>Contact us</h5>
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
    <div class="card p-4">
            <form action="{{route('admin.contact.addContact')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Heading</label>
                    <textarea class="form-control summernote" id="" name="banner_content" rows="3">{{$data->banner_content}}</textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            <!-- <div class="card p-4">
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
                        <td>{!! $card->detail !!}</td>
                        <td>  <a data-bs-toggle="modal" data-bs-target="#contactCard{{$card->id}}" class="btn btn-primary">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <!-- <div class="modal fade" id="contactCard{{$card->id}}" tabindex="-1" aria-labelledby="contactCardLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contactCardLabel">Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('admin.contact.updateContact')}}" method="post" enctype="multipart/form-data">
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
                                    <textarea class="form-control summernote" id="card_detail" name="card_detail" rows="3">{{$card->detail}}</textarea>
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
            </div>  -->
        </form>
    </div>

    <div class="card p-4 mt-4">
        <form action="{{route('admin.contact.section1Contact')}}" method="post">
        @csrf
            <div class="mb-3">
                <label for="section1Content" class="form-label">Section 1</label>
                <textarea class="form-control summernote" id="section1Content" name="section1Content" rows="3">{{$data->section1Content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="section2Content" class="form-label">Section 2</label>
                <textarea class="form-control summernote" id="section2Content" name="section2Content" rows="3">{{$data->section2Content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="section3Content" class="form-label">Section 3</label>
                <textarea class="form-control summernote" id="section3Content" name="section3Content" rows="3">{{$data->section3Content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="section4Content" class="form-label">Section 4</label>
                <textarea class="form-control summernote" id="section4Content" name="section4Content" rows="3">{{$data->section4Content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="section5Content" class="form-label">Section 5</label>
                <textarea class="form-control summernote" id="section5Content" name="section5Content" rows="3">{{$data->section5Content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="section6Content" class="form-label">Section 6</label>
                <textarea class="form-control summernote" id="section6Content" name="section6Content" rows="3">{{$data->section6Content}}</textarea>
            </div>
            <div class="mt-3">
                 <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
    <div class="card p-4 mt-4">
        <form action="{{route('admin.contact.bannerContact')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input  accept="image/*" class="form-control" type="file" id="imgInp" name="banner" >
            </div>
            <img id="blah" src="{{asset('images')}}/{{$data->banner_image}}" />
            <div class="mb-3">
                <button type="sumit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

    <div class="card p-4 mt-4">
        <form action="{{route('admin.contact.lastSectionContact')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="lastSection" class="form-label">Last Section</label>
                <textarea class="form-control summernote" id="lastSection" name="lastSection" rows="3">{{$data->last_section}}</textarea>
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

imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
</script>
@endsection
