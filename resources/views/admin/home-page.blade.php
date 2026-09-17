@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Home page</h1>
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
            <button class="nav-link active" id="banner-tab" data-bs-toggle="tab" data-bs-target="#banner" type="button" role="tab" aria-controls="banner" aria-selected="true">Banner Image</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="offer-tab" data-bs-toggle="tab" data-bs-target="#offer" type="button" role="tab" aria-controls="offer" aria-selected="true">Offers Section</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="learn-tab" data-bs-toggle="tab" data-bs-target="#learn" type="button" role="tab" aria-controls="learn" aria-selected="false">Learn More Section</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="carRental-tab" data-bs-toggle="tab" data-bs-target="#carRental" type="button" role="tab" aria-controls="carRental" aria-selected="false">Car Rental Section</button>
        </li>
    </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="banner" role="tabpanel" aria-labelledby="banner-tab">
    <form action="{{route('admin.homeBanner')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input  accept="image/*" class="form-control" type="file" id="imgInp" name="banner" >
        </div>

        <img id="blah" src="{{asset('images')}}/{{$banner->image}}" />
      
      <div class="mt-4">
         <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </form>
  </div>
  <div class="tab-pane fade " id="offer" role="tabpanel" aria-labelledby="offer-tab">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Heading</th>
                <th>Discription</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
            <tr>
                <td><img src="{{asset('images/')}}/{{$offer->icon_image}}" alt=""></td>
                <td>{{$offer->heading}}</td>
                <td>{{$offer->discription}}</td>
                <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$offer->id}}">Edit</a></td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{$offer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <form action="{{route('admin.createOffer')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$offer->id}}" name="id">
                    <div class="modal-body">    
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input class="form-control" type="file" id="icon" name="icon_image" >
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{$offer->heading}}">
                        </div>
                        <div class="mb-3">
                            <label for="discription" class="form-label">Discription</label>
                            <textarea class="form-control" id="discription" rows="3" name="discription">{{$offer->discription}}</textarea>
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
  <div class="tab-pane fade " id="learn" role="tabpanel" aria-labelledby="learn-tab">
     <table id="example1" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Heading</th>
                <th>Discription</th>
                <th>Button</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr>
                <td style="width:10%"><img src="{{asset('images/')}}/{{$blog->image}}" alt=""></td>
                <td>{{$blog->heading}}</td>
                <td>{{$blog->discription}}</td>
                <td>{{$blog->button}}</td>
                <td><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#learn{{$blog->id}}">Edit</a></td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="learn{{$blog->id}}" tabindex="-1" aria-labelledby="learnLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="learnLabel">Edit learn more section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <form action="{{route('admin.homeLearn')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$blog->id}}" name="id">
                    <div class="modal-body">    
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{$blog->heading}}">
                        </div>
                        <div class="mb-3">
                            <label for="discription" class="form-label">Discription</label>
                            <textarea class="form-control" id="discription" rows="3" name="discription">{{$blog->discription}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="button" class="form-label">Buttton</label>
                            <input type="text" class="form-control" id="button" name="button" value="{{$blog->button}}">
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" class="form-control" id="link" name="link" value="{{$blog->link}}">
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
  <div class="tab-pane fade" id="carRental" role="tabpanel" aria-labelledby="carRental-tab">
    <form action="{{route('admin.rentalHeading')}}" method="post">
        @csrf
        <div class="row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Heading" value="{{$carHead->heading}}" name="main_heading">
            </div>
            <div class="col">
              <input type="text" class="form-control" placeholder="Detail" value="{{$carHead->detail}}" name="main_detail">
            </div>
            <div class="col">
              <label ></label>
              <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
    <div class="card mt-5">
        <div class="p-3">
         <h6 >Car Rental Offers</h6>
         <table id="example2" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Heading</th>
                    <th>Detail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carsOffres as $offer)
                <tr>
                    <td>{{$offer->offer_heading}}</td>
                    <td>{{$offer->offer_detail}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#caroffer{{$offer->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="caroffer{{$offer->id}}" tabindex="-1" aria-labelledby="carofferLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="carofferLabel">Edit car rental section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.rentalOffer')}}" method="post" >
                        @csrf
                        <input type="hidden" value="{{$offer->id}}" name="id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="heading" name="offer_heading" value="{{$offer->offer_heading}}">
                            </div>
                            <div class="mb-3">
                                <label for="discription" class="form-label">Discription</label>
                                <textarea class="form-control" id="discription" rows="3" name="offer_discription">{{$offer->offer_detail}}</textarea>
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
    <div class="card mt-5">
        <div class="p-3">
         <h6 >Car Rental Cards</h6>
         <table id="example3" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Image Title</th>
                    <th>Heading</th>
                    <th>Detail</th>
                    <th>button</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <td style="width:10%"><img src="{{asset('images')}}/{{$card->card_image}}" alt="{{$card->card_image}}"> </td>
                    <td>{{$card->image_title}}</td>
                    <td>{{$card->card_heading}}</td>
                    <td>{{$card->card_detail}}</td>
                    <td>{{$card->button}}</td>
                    <td><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#carcard{{$card->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="carcard{{$card->id}}" tabindex="-1" aria-labelledby="carcardLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="carofferLabel">Edit car rental section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.rentalCard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$card->id}}" name="id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="icon" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image" >
                            </div>
                            <div class="mb-3">
                                <label for="image_title" class="form-label">Image Title</label>
                                <input type="text" class="form-control" id="image_title" name="image_title" value="{{$card->image_title}}">
                            </div>
                            <div class="mb-3">
                                <label for="heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="heading" name="heading" value="{{$card->card_heading}}">
                            </div>
                            <div class="mb-3">
                                <label for="detail" class="form-label">Detail</label>
                                <textarea class="form-control" id="detail" rows="3" name="detail">{{$card->card_detail}}</textarea>
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
  </div>
</div>
  
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
</script>
@endsection
