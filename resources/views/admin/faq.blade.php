@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Customer Service</h3>
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
            <button class="nav-link active" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true">Faq</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ques-tab" data-bs-toggle="tab" data-bs-target="#ques" type="button" role="tab" aria-controls="ques" aria-selected="true">Faq Question</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="faq" role="tabpanel" aria-labelledby="faq-tab">   
        <div class="card m-3 p-4">
            <table id="" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Topics</th>
                        <th style="width:40%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($topics as $topic)
                    <tr>
                        <td>{{$topic->topic}}</td>
                        <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#topic{{$topic->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="topic{{$topic->id}}" tabindex="-1" aria-labelledby="topicLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="topicLabel">Edit Topic</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('admin.service.editFaq')}}" method="post" >
                            @csrf
                            <input type="hidden" value="{{$topic->id}}" name="topic_id">
                            <div class="modal-body">    
                                <div class="mb-3">
                                    <label for="topic" class="form-label">Topic</label>
                                    <input type="text" class="form-control" id="topic" name="topic" value="{{$topic->topic}}">
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
    <div class="tab-pane fade" id="ques" role="tabpanel" aria-labelledby="ques-tab">   
    <div class="card m-3 p-4">
        <form action="" method="post">
            <h6>Select Main Topic</h6>
            <select class="form-select" aria-label="Default select example" id="mainQuestion">
                <option>Select</option>
                @foreach($topics as $topic)
                   <option value="{{$topic->id}}" >{{$topic->topic}}</option>
                @endforeach
            </select> 
            <h6 class="my-4">Question/Answer</h6>
            <div class="card  p-4">
                <table id="" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <!-- <th>Answer</th> -->
                            <th style="width:40%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="question_data">
                    
                    </tbody>
                </table>
           </div>
        </form>
     </div>
    </div>


</div>
  
    </div>
</section>
<!-- model -->
<div class="modal fade" id="edit_question_answer" tabindex="-1" aria-labelledby="edit_question" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit_question">Edit Question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('admin.service.editQuestion')}}" method="post" >
            @csrf
            <div id="single_question_data">
            <input type="hidden" value="" name="question_id" id="question_id">
              <div class="modal-body">    
                  <div class="mb-3">
                      <label for="question" class="form-label">Question</label>
                      <input type="text" class="form-control" id="question" name="question" value="">
                  </div>
                  <div class="mb-3">
                    <label for="answer" class="form-label">Answer</label>
                    <textarea class="form-control ckeditor" id="qu_answer" name="answer" rows="3"></textarea>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div> 



<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    	    window.onload = function() {
        CKEDITOR.replace('.ckeditor');
    };
// $(document).ready(function() {
//       $('.summernote').summernote();
//     });

    $('#mainQuestion').change(function () {
    let topic = $(this).val(); 
    $.ajax({
        type: "get",
        url: "{{route('admin.service.viewFaq')}}",
        data: {
            "topic": topic
        },
        // <td>${val.answer}</td>
        success: function (data) {
           $('#question_data').html('');
           $.each(data.data, function(i, val){
                $('#question_data').append(`<tr>
                        <td>${val.question}</td>
                      
                        <td><a class="btn btn-primary" onclick="editModel(${val.id});">Edit</a></td>
                    </tr>   
                `);
           });  
        }
    });
});
 

function editModel($id){
  
  $.ajax({
      type: "get",
      url: "{{route('admin.service.viewQuestion')}}",
      data: {
          "id": $id
      },
      success: function (data) {

 
         if(data.status == 'success'){
            //  $('#single_question_data').append(`<input type="hidden" value="${data.data.id}" name="question_id">
            //   <div class="modal-body">    
            //       <div class="mb-3">
            //           <label for="question" class="form-label">Question</label>
            //           <input type="text" class="form-control" id="question" name="question" value="${data.data.question}">
            //       </div>
            //       <div class="mb-3">
            //         <label for="answer" class="form-label">Answer</label>
            //         <textarea class="form-control summernote" id="answer" name="answer" rows="3">${data.data.answer}</textarea>
            //       </div>
            //   </div>
            //  `);
            var editor = CKEDITOR.instances.qu_answer;
            $('#question_id').val(data.data.id);
            $('#question').val(data.data.question);
            editor.setData(editor.getData() + data.data.answer); // Append and set data
        
             $('#edit_question_answer').modal('show');
         }
      }
  });
}

</script>

@endsection
