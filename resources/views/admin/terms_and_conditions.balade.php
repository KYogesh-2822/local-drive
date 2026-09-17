@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Terms And Conditions</h3>
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
                            <tr>
                                <!-- <th>Id</th>
                                <th>Heading</th>
                                <th>Paragraph</th>
                                <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <form action="{{route('admin.conditions.addconditions')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="term_id" value="{{$condition->id}}">
                                    <div class="modal-body">
                                        
                                        <div class="mb-3">
                                            <label for="heading" class="form-label">Heading</label>
                                            <input type="text" class="form-control" id="heading" name="heading" value="{{$condition->heading}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="policy_paragraph" class="form-label">Paragraph</label>
                                            <textarea class="form-control edit_summernote" id="paragraph" rows="3" name="paragraph">{{$condition->paragraph}}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </tr>
                            
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
      $('.edit_summernote').summernote();
    });


</script>
@endsection
