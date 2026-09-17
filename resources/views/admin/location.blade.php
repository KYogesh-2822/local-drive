@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Location</h3>
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
            <button class="nav-link active" id="us-tab" data-bs-toggle="tab" data-bs-target="#us" type="button" role="tab" aria-controls="us" aria-selected="true">Jordan Locations</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="inter-tab" data-bs-toggle="tab" data-bs-target="#inter" type="button" role="tab" aria-controls="inter" aria-selected="true">International Car Rental Locations </button>
        </li>

    </ul>
  <div class="tab-content" id="myTabContent">
   <div class="tab-pane fade show active" id="us" role="tabpanel" aria-labelledby="us-tab">
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Top Heading</h5>
        <form action="{{route('admin.location.editHeading')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="loc_heading" class="form-label">Heading</label>
                <input type="text" class="form-control" id="loc_heading" name="loc_heading" value="{{$data->heading ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="loc_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="loc_button" name="loc_button" value="{{$data->button ?? ''}}">
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Content Section</h5>
        <form action="{{route('admin.location.editContent')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="loc_us_content" class="form-label">Content</label>
                <textarea class="form-control summernote" id="loc_us_content" name="loc_us_content" rows="3">{!! $data->content !!}</textarea>
                <!-- <textarea class="form-control ckeditor" id="loc_us_content" rows="1" name="loc_us_content">{!! $data->content !!}</textarea> -->
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">FAQ Section</h5>
        <form action="{{route('admin.location.editUsFaq')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="faq_heading" class="form-label">Faq Heading</label>
                <input type="text" class="form-control" id="faq_heading" name="faq_heading" value="{{$data->faq_heading}}">
            </div>
            <div class="mb-3">
                <label for="faq_footer" class="form-label">faq Footer</label>
                <textarea class="form-control summernote" id="faq_footer" name="faq_footer" rows="3">{{$data->faq_footer}}</textarea>
                <!-- <textarea class="form-control ckeditor" id="faq_footer" rows="1" name="faq_footer">{{$data->faq_footer}}</textarea> -->
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
  </div>
  <div class="tab-pane fade " id="inter" role="tabpanel" aria-labelledby="inter-tab"> 
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Top Heading</h5>
        <form action="{{route('admin.location.editInterHeading')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="inter_loc_heading" class="form-label">Heading</label>
                <input type="text" class="form-control" id="inter_loc_heading" name="inter_loc_heading" value="{{$data_inter->heading ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="inter_loc_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="inter_loc_button" name="inter_loc_button" value="{{$data_inter->button ?? ''}}">
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Content Section</h5>
        <form action="{{route('admin.location.editInterContent')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="loc_inter_content" class="form-label">Content</label>
                <textarea class="form-control summernote" id="loc_inter_content" name="loc_inter_content" rows="3">{{$data_inter->content }}</textarea>
                <!-- <textarea class="form-control ckeditor" id="loc_inter_content" rows="1" name="loc_inter_content">{{$data_inter->content }}</textarea> -->
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Companies card</h5>
            <table id="example" class="table table-striped" style="width:100%">
                 <thead>
                <tr>
                    <th>Image</th>
                    <th>Detail</th>
                    <th>button</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($cards as $card)
                    <tr>
                        <td><img src="{{asset('images/')}}/{{$card->image}}" alt=""  width="200" height="100"></td>
                        <td>{{$card->detail}}</td>
                        <td>{{$card->button}}</td>
                        <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#companyCard{{$card->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="companyCard{{$card->id}}" tabindex="-1" aria-labelledby="companyCardLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="companyCardLabel">Edit Company</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <form action="{{route('admin.location.editInterCard')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$card->id}}" name="id">
                                <div class="modal-body">    
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">detail</label>
                                
                                        <textarea class="form-control" id="detail" rows="3" name="detail">{{$card->detail}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="button" class="form-label">Button</label>
                                        <input type="text" class="form-control" id="button" name="button" value="{{$card->button}}">
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
  <div class="tab-pane fade " id="state" role="tabpanel" aria-labelledby="state-tab"> 
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Select State first</h5>
        <form action="{{route('admin.location.addUsCities')}}" method="post">
            @csrf
            <select class="form-select" aria-label="Default select example" name="state" id="us_state" required>
                <option value="" selected>Select State</option>
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
            <div class="card mt-4 p-4" id="cities_response">
                <span>Select State First</span>
            </div>
            <div class="mb-3 mt-4">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>State</th>
                    <th>Cities</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($state_cities as $cities)
                    <tr>
                        <td>{{$cities->name}}</td>
                        <?php 
                            $a = json_decode($cities->cities_id);
                            $name = DB::table('cities')->select('name')->whereIn('id',$a)->get();
                            
                        ?>
                        <td>@foreach($name as $nam) {{$nam->name}},  @endforeach<td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
  </div>
  <div class="tab-pane fade " id="region" role="tabpanel" aria-labelledby="region-tab"> 
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Select Region first</h5>
        <form action="{{route('admin.location.addRegionCountries')}}" method="post">
            @csrf
            <select class="form-select" aria-label="Default select example" name="region" id="us_region" required>
                <option value="" selected>Select Region</option>
                @foreach($regions as $region)
                <option value="{{$region->id}}">{{$region->name}}</option>
                @endforeach
            </select>
            <div class="card mt-4 p-4" id="country_response">
                <span>Select Region First</span>
            </div>
            <div class="mb-3 mt-4">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>


      <div class="card p-3 mt-4">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>Region</th>
                    <th>Countries</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($inter_regions as $inter_region)
                    <tr>
                        <td>{{$inter_region->name}}</td>
                        <?php 
                            $a = json_decode($inter_region->countries);
                            $name = DB::table('countries')->select('name')->whereIn('id',$a)->get();
                            
                        ?>
                        <td>@foreach($name as $nam) {{$nam->name}},  @endforeach<td>
                        @if($inter_region->region_id == 2)
                            <td><button class="btn" data-bs-toggle="modal" data-bs-target="#popular">View</button><td>
                            @else
                            <td></td>
                            <!-- Modal -->
                            <div class="modal fade" id="popular" tabindex="-1" aria-labelledby="popularLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="popularLabel">Popular Destinations from the U.S.</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.location.addUsPopular')}}" method="post">
                                        @csrf
                                           @foreach($popular as $pop)
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="popular_name" name="pupular_country_id[]" {{in_array($pop->id, $popular_ids) ? 'checked' : ''}} value="{{$pop->id}}">
                                                <label class="form-check-label" for="popular_name"> {{$pop->name}}</label>
                                            </div>
                                            @endforeach
                                            <div class="mt-4">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                    </form>
                                </div>
                      
                                </div>
                            </div>
                            </div>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
  </div>

</div>
  
    </div>
</section>


<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.summernote').summernote();
    });
  </script>

<script>
    window.onload = function() {
        CKEDITOR.replace('.ckeditor');
    };

$('#us_region').change(function(){
    var val = $(this).val();
    $.ajax({
        url: "{{route('admin.location.showCountries')}}",
        data: { 'region_id': val },
        type: "get",
        success: function(data){
           console.log(data);
           $('#country_response').html('');
           $.each(data.region, function (key, val) {
                $('#country_response').append(`<div class="form-check">
                        <input class="form-check-input" type="checkbox" value="${val.id}" id="us_region_country${val.id}" name="country[]" >
                        <label class="form-check-label" for="us_region_country${val.id}">
                           ${val.name}
                        </label>
                    </div>
                `);
            });
        }
    });
});

$('#us_state').change(function(){
    var val = $(this).val();
    $.ajax({
        url: "{{route('admin.location.usCities')}}",
        data: { 'state_id': val },
        type: "get",
        success: function(data){
           console.log(data);
           $('#cities_response').html('');
           $.each(data.cities, function (key, val) {
                $('#cities_response').append(`<div class="form-check">
                        <input class="form-check-input" type="checkbox" value="${val.id}" id="us_cities${val.id}" name="cities[]" >
                        <label class="form-check-label" for="us_cities${val.id}">
                           ${val.name}
                        </label>
                    </div>
                `);
            });
        }
    });
});
</script>
@endsection
