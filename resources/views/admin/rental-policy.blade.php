@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Rental Policies</h3>
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
    <a href="{{route('admin.policy.addPolicy')}}" class="btn btn-primary">Add Policy</a>
    <div class="card m-3 p-4">
        <table id="" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Heading</th>
                    <th>Detail</th>
                    <th style="width:40%">Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($policies as $top)
                <tr>
                    <td>{{$top->heading}}</td>
                    <td>{{$top->detail}}</td>
                    <td><a href="{{route('admin.policy.editPolicy')}}/{{$top->id}}" class="btn btn-primary">Edit</a>
                    <a onclick="deletePolicy({{$top->id}})" class="btn btn-danger">Delete</a></td>
                </tr>
            
                @endforeach
            </tbody>
        </table>
    </div>


</section>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });

    function deletePolicy($id){
            Swal.fire({
                title: "Are you sure?",
                text: "You would like to delete this policy!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                 
                if (result.isConfirmed) {
                   
                    $.ajax({
                        url : "{{route('admin.policy.deletePolicy')}}",
                        data : {'id':$id},
                        type : 'GET',
                        dataType : 'json',
                        success : function(response){
              
                           $('custom_success_message').html('');
                            if(response == 1){
                                $('custom_success_message').append(` <div class="alert alert-success mt-2">Policy deleted succesfully. </div>`)
                                location.reload();
                            }   
                            
                        }
                    });
                }
            });
       }
</script>
@endsection