@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h3>Business</h3>
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
        <div class="card p-4">
           <h6>Banner Section</h6>
            <form action="{{route('admin.business.businessBanner')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="banner_text" class="form-label">Banner Text</label>
                    <textarea class="form-control summernote" id="banner_text" rows="3" name="banner_text">{{$data->banner_content}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="first_button" class="form-label">Button</label>
                    <input class="form-control" type="text" id="first_button" name="first_button" value="{{$data->first_button}}">
                </div>
                <div class="mb-3">
                   <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <div class="card p-4 mt-4">
           <h6>Sign Up Section</h6>
            <form action="{{route('admin.business.businessTodayHeading')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="today_business_heading" id="today_business_heading" value="{{$data->today_business_heading}}">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Heading</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($business_today as $today)
                    <tr>
                        <td><img src="{{asset('images/')}}/{{$today->image}}" alt=""></td>
                        <td>{{$today->heading}}</td>
                        <td>{!! $today->detail !!}</td>
                        <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#todayBusiness{{$today->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="todayBusiness{{$today->id}}" tabindex="-1" aria-labelledby="todayBusinessLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="todayBusinessLabel">Edit Business</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('admin.business.businessToday')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$today->id}}" name="id">
                                <div class="modal-body">          
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input  accept="image/*" class="form-control" type="file" id="image" name="image" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="heading" class="form-label">Heading</label>
                                        <input type="text" class="form-control" id="heading" name="heading" value="{{$today->heading}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Detail</label>
                                        <textarea class="form-control summernote" id="detail" rows="2" name="detail">{{$today->detail}}</textarea>
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
     
        <div class="card p-4 mt-4">
           <h6>Rentail Program Section</h6>
            <form action="{{route('admin.business.businessRentailProgram')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="business_rental_program" id="business_rental_program" value="{{$data->rentail_program_heading}}">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
            <table id="example" class="table table-striped mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Button Text</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($business_rentail as $rentail)
                    <tr>
                        <td>{!! $rentail->text !!}</td>
                        <td>{{$rentail->button}}</td>
                        <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rentailBusiness{{$rentail->id}}">Edit</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="rentailBusiness{{$rentail->id}}" tabindex="-1" aria-labelledby="rentailBusinessLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rentailBusinessLabel">Edit Business</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('admin.business.businessRentail')}}" method="post" >
                                @csrf
                                <input type="hidden" value="{{$rentail->id}}" name="id">
                                <div class="modal-body">          
                                    <div class="mb-3">
                                        <label for="detail" class="form-label">Detail</label>
                                        <textarea class="form-control summernote" id="detail" rows="2" name="detail">{{$rentail->text}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="button" class="form-label">Button Text</label>
                                        <input  class="form-control" type="text" name="button" value="{{$rentail->button}}">
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
            <form action="{{route('admin.business.businessRentailImages')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="formFile" class="form-label">Multi Images</label>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="file" id="formFile" name="multi_image[]" multiple>
                    </div>
                    @if($data->rentail_program_images != '')
                    <div class="my-4 row">
                        <?php $images = explode(",",$data->rentail_program_images); ?>
                        @foreach($images as $image)
                         <div class="col-lg-2">
                            <img src="{{asset('images/')}}/{{$image}}" alt=""> 
                         </div>
                         @endforeach
                    </div>
                    @endif
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card p-4 mt-4">
           <h6>Choose Enterprise Section</h6>
            <form action="{{route('admin.business.chooseenterprise')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" name="enterprise_heading" id="enterprise_heading" value="{{$data->enterprise_heading}}">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
            <form action="{{route('admin.business.choosecontent')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="choose_content1" class="form-label">Content1</label>
                    <textarea class="form-control summernote" id="choose_content1" rows="3" name="choose_content1">{{$data->choose_content1}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="choose_content2" class="form-label">Content2</label>
                    <textarea class="form-control summernote" id="choose_content2" rows="3" name="choose_content2">{{$data->choose_content2}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="choose_content3" class="form-label">Content3</label>
                    <textarea class="form-control summernote" id="choose_content3" rows="3" name="choose_content3">{{$data->choose_content3}}</textarea>
                </div>

                <div class="mb-3">
                   <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>

        <div class="card p-4 mt-4">
           <h6>Choose Enterprise Section</h6>
            <form action="{{route('admin.business.signingUp')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="signing_up_step" class="form-label">content</label>
                    <textarea class="form-control summernote" id="signing_up_step" rows="3" name="signing_up_step">{{$data->signing_up_step}}</textarea>
                </div>

                <div class="mb-3">
                   <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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

    // car_banner_image.onchange = evt => {
    //     const [file] = car_banner_image.files
    //     if (file) {
    //         car_banner_blah.src = URL.createObjectURL(file)
    //     }
    // }
 
</script>
@endsection
