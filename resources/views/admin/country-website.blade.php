@extends("layouts.admin.header-content")
@section('content')
<style>
div#example_filter {
    float: inline-end;
}
div#example_paginate {
    float: inline-end;
}
</style>
<section class="dashboard">
    <div class="common-heading">
        <h4>Websites by Country</h4>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <div>
        <div class="card p-4">
           <form action="{{route('admin.website.updateCountryLink')}}" method="post">
            @csrf
            <label for="" class="form-label">Select country</label>
            <select class="form-select" aria-label="Default select example" id="website_country" name="country_id" required>
                <option value="">select</option>
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            <div class="country_link_div">
               
            </div>
            </form>
        </div>


        <div class="card p-4 mt-4">
            <h6>Websites by Country</h6>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Country </th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($country_links as $link)
                    <tr>
                        <td> {{$link->name}}</td>
                        <td> {{$link->link}}</td>
                        <td>  <a onclick="deleteLink({{$link->id}});" class="btn btn-alert">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    // new DataTable('#example');
$('#example').DataTable({
    "ordering": false,
    "info":     false,
    "dom": 'ftip'
});

$('#website_country').change(function(){
   var country_id = $(this).val();

    $.ajax({
        url: "{{route('admin.website.viewCountry')}}",
        data: {'id' : country_id},
        type: "get",
        success: function(data){
          $('.country_link_div').html('');
          $('.country_link_div').append(` <div class="row mt-5">
                    <div class="col">
                        <label for="country_name" class="form-label">Country</label>
                        <input type="text" class="form-control" name="country_name" id="country_name" value="${data.data.name}" readonly>
                    </div>
                    <div class="col">
                        <label for="website_link" class="form-label">Link</label>
                        <input type="text" class="form-control" name="website_link" id="website_link" value="${data.data.link}">
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
          `);
        }
    });
});

function deleteLink($id){	
	Swal.fire({
       title: "Are you sure you want to delete this Link.",
       icon: "warning",
       buttons: true,
       dangerMode: true,
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
              url: "{{route('admin.website.deleteCountryLink')}}",
              type: "get",
              dataType: "json",
              data: { id : $id },
              success: function(data){
                if(data.status == 'success'){
                  Swal.fire(data.message);
                }
                setTimeout(function(){
                window.location.reload();
                }, 3000);
              },
          });
        }else{
          swal("Something went wrong");
        }
   });

}
</script>
@endsection
