@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Terms Of Use</h3>
        <!-- <a data-bs-toggle="modal" data-bs-target="#contactCard" class="btn btn-primary">Add</a> -->
        
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
        
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="deal" role="tabpanel" aria-labelledby="deal-tab">
                
                <div class="card p-4 mt-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <!-- <tr>
                                <th>Heading</th>
                                <th>Paragraph</th>
                                <th>Action</th>
                            </tr> -->
                        </thead>
                        <tbody>
                            <tr>
                            <form action="{{route('admin.terms.updateterms')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="term_id" value="{{$term->id}}">
                                    <div class="modal-body">
                                        
                                        <div class="mb-3">
                                            <label for="term_heading" class="form-label">Heading</label>
                                            <input type="text" class="form-control" id="term_heading" name="term_heading" value="{{$term->term_heading}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="card_detail" class="form-label">Contents</label>
                                            <textarea class="form-control edit_summernote" id="paragraph" rows="3" name="paragraph">{{$term->paragraph}}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </tr>
                            <!-- Modal -->
                            <!-- <div class="modal fade" id="contactCard{{$term->id}}" tabindex="-1" aria-labelledby="contactCardLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactCardLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                
                                </div>
                            </div>
                            </div> -->
                        </tbody>
                    </table>

                    <!-- Add Modal -->
                    <!-- <div class="modal fade" id="contactCard" tabindex="-1" aria-labelledby="contactCardLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactCardLabel">Add</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('admin.terms.addterms')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        
                                        <div class="mb-3">
                                            <label for="term_heading" class="form-label">Heading</label>
                                            <input type="text" class="form-control" id="term_heading" name="term_heading">
                                        </div>
                                        <div class="mb-3">
                                            <label for="card_detail" class="form-label">Paragraph</label>
                                            <textarea class="form-control summernote" id="paragraph" rows="3" name="paragraph"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div> -->



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

    $(document).ready(function() {
      $('.edit_summernote').summernote();
    });


</script>
@endsection
