@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Reservation</h1>
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
            <button class="nav-link active" id="reservation-tab" data-bs-toggle="tab" data-bs-target="#reservation" type="button" role="tab" aria-controls="reservation" aria-selected="true">Start a Reservation</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="vmc-tab" data-bs-toggle="tab" data-bs-target="#vmc" type="button" role="tab" aria-controls="vmc" aria-selected="true">View Modify Cancel</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="receipt-tab" data-bs-toggle="tab" data-bs-target="#receipt" type="button" role="tab" aria-controls="receipt" aria-selected="false">Get a Receipt</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="shortTerm-tab" data-bs-toggle="tab" data-bs-target="#shortTerm" type="button" role="tab" aria-controls="shortTerm" aria-selected="false">Short-Term Car Rental</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="subscribe-tab" data-bs-toggle="tab" data-bs-target="#subscribe" type="button" role="tab" aria-controls="subscribe" aria-selected="false">Subscribe with Enterprise</button>
        </li> -->
    </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="reservation" role="tabpanel" aria-labelledby="reservation-tab">
    <div class="card p-4">
        <h5>First Section</h5>
        <form action="{{route('admin.reservationIntro')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="discription">Discription</label>
                <textarea class="form-control ckeditor" id="discription" name="discription" rows="3">{{$intro->discription ?? ''}}</textarea>
            </div>
            <div class="mt-2">
                <label for="image" class="form-label">Image</label>
                <input class="form-control form-control-lg" id="image" name="image"type="file">
            </div>
            <img class="mt-2" id="blah" src="{{asset('images')}}/{{$intro->image ?? ''}}" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card p-4 mt-4">
       <h5>Second Section</h5>
        <table id="" class="table table-striped" style="width:100%">
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
                @foreach($first_cards as $first)
                <tr>
                    <td style="width:10%"><img src="{{asset('images/')}}/{{$first->image}}" alt=""></td>
                    <td>{{$first->heading}}</td>
                    <td>{{$first->detail}}</td>
                    <td>{{$first->button}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#firstcard{{$first->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="firstcard{{$first->id}}" tabindex="-1" aria-labelledby="firstcardLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="firstcardLabel">Edit section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.reservationFirstcard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$first->id}}" name="section1_id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="section1_heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="section1_heading" name="section1_heading" value="{{$first->heading}}">
                            </div>
                            <div class="mb-3">
                                <label for="section1_image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="section1_image" name="section1_image" >
                            </div>
                            <div class="mb-3">
                                <label for="section1_discription" class="form-label">Discription</label>
                                <textarea class="form-control" id="section1_discription" rows="3" name="section1_discription">{{$first->detail}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="button" class="form-label">Button</label>
                                <input type="text" class="form-control"  name="section1_button" value="{{$first->button}}">
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
       <h5>Third Section</h5>
        <table id="" class="table table-striped" style="width:100%">
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
                @foreach($second_cards as $second)
                <tr>
                    <td style="width:10%"><img src="{{asset('images/')}}/{{$second->image}}" alt=""></td>
                    <td>{{$second->heading}}</td>
                    <td>{{$second->detail}}</td>
                    <td>{{$second->button}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#secondcard{{$second->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="secondcard{{$second->id}}" tabindex="-1" aria-labelledby="secondcardLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="secondcardLabel">Edit section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.reservationSecondcard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$second->id}}" name="section2_id">
                        <div class="modal-body">  
                            <div class="mb-3">
                                <label for="section2_image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="section2_image" name="section2_image" >
                            </div>  
                            <div class="mb-3">
                                <label for="section2_heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="section2_heading" name="section2_heading" value="{{$second->heading}}">
                            </div>
                            <div class="mb-3">
                                <label for="section2_discription" class="form-label">Discription</label>
                                <textarea class="form-control" id="section2_discription" rows="3" name="section2_discription">{{$second->detail}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="button" class="form-label">Button</label>
                                <input type="text" class="form-control"  name="section2_button" value="{{$second->button}}">
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
       <h5>Forth Section</h5>
        <table id="" class="table table-striped" style="width:100%">
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
                @foreach($third_cards as $third)
                <tr>
                    <td style="width:10%"><img src="{{asset('images/')}}/{{$third->image}}" alt=""></td>
                    <td>{{$third->heading}}</td>
                    <td>{{$third->detail}}</td>
                    <td>{{$third->button}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#thirdcard{{$third->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="thirdcard{{$third->id}}" tabindex="-1" aria-labelledby="thirdcardLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="thirdcardLabel">Edit section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.reservationThirdcard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$third->id}}" name="section3_id">
                        <div class="modal-body">  
                            <div class="mb-3">
                                <label for="section3_image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="section3_image" name="section3_image" >
                            </div>  
                            <div class="mb-3">
                                <label for="section3_heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="section3_heading" name="section3_heading" value="{{$third->heading}}">
                            </div>
                            <div class="mb-3">
                                <label for="section3_discription" class="form-label">Discription</label>
                                <textarea class="form-control" id="section3_discription" rows="3" name="section3_discription">{{$third->detail}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="button" class="form-label">Button</label>
                                <input type="text" class="form-control"  name="section3_button" value="{{$third->button}}">
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
  <div class="tab-pane fade " id="vmc" role="tabpanel" aria-labelledby="vmc-tab">
    <div class="card p-5">
        <form action="{{route('admin.reservationVmc')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="vmc_heading" class="form-label">Heading</label>
                <input type="text" class="form-control" id="vmc_heading" name="vmc_heading" value="{{$vmc->heading ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="vmc_discription" class="form-label">Discription</label>
                <textarea class="form-control" id="vmc_discription" rows="2" name="vmc_discription">{{$vmc->discription ?? ''}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </div>
  <div class="tab-pane fade " id="receipt" role="tabpanel" aria-labelledby="receipt-tab">
    <div class="card p-5">
            <form action="{{route('admin.reservationReceipt')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="receipt_heading" class="form-label">Heading</label>
                    <input type="text" class="form-control" id="receipt_heading" name="receipt_heading" value="{{$receipt->heading}}">
                </div>
                <div class="mb-3">
                    <label for="receipt_discription" class="form-label">Discription</label>
                    <textarea class="form-control" id="receipt_discription" rows="2" name="receipt_discription">{{$receipt->discription}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
  </div>
  <div class="tab-pane fade" id="shortTerm" role="tabpanel" aria-labelledby="shortTerm-tab">
    <div class="card p-4">
      <h5 class="mb-2">Banner Section</h5>
        <form action="{{route('admin.reservationshortTermBanner')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="shortTerm_banner_heading" class="form-label">Heading</label>
                <input type="text" class="form-control" id="shortTerm_banner_heading" name="shortTerm_banner_heading" value="{{$shortTerm_banner->heading}}">
            </div>
            <div class="mb-3">
                <label for="shortTerm_banner_discription" class="form-label">Discription</label>
                <textarea class="form-control" id="shortTerm_banner_discription" rows="2" name="shortTerm_banner_discription">{{$shortTerm_banner->discription}}</textarea>
            </div>
            <div class="mt-2">
                <label for="shortTerm_banner_image" class="form-label">Image</label>
                <input class="form-control form-control-lg" id="shortTerm_banner_image" name="shortTerm_banner_image" type="file">
            </div>
            <img class="mt-2" id="shortTerm_banner_blah" src="{{asset('images')}}/{{$shortTerm_banner->image ?? ''}}" style="width:50%;" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card p-4 mt-4">
      <h5 class="mb-2">Short Term Benefits</h5>
        <form action="{{route('admin.reservationshortTermBenefit')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="shortTerm_benefit" class="form-label">Text</label>
                <textarea class="form-control ckeditor" id="shortTerm_benefit" rows="3" name="shortTerm_benefit">{{$shortTerm_banner->shortTerm_benefit}}</textarea>
            </div>
            <div class="mb-3">
                <label for="why_shortTerm" class="form-label">Text</label>
                <textarea class="form-control ckeditor" id="why_shortTerm" rows="3" name="why_shortTerm">{{$shortTerm_banner->why_shortTerm}}</textarea>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card p-4 mt-4">
      <h5 class="mb-2">Short Term Cards</h5>
      <table id="" class="table table-striped" style="width:100%">
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
                @foreach($shortTerm_cards as $card)
                <tr>
                    <td style="width:10%"><img src="{{asset('images/')}}/{{$card->image}}" alt=""></td>
                    <td>{{$card->heading}}</td>
                    <td>{{$card->detail}}</td>
                    <td>{{$card->button}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shortTermcard{{$card->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="shortTermcard{{$card->id}}" tabindex="-1" aria-labelledby="shortTermcardLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="shortTermcardLabel">Edit section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('admin.reservationshortTermCard')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$card->id}}" name="shortTerm_card_id">
                            <div class="modal-body">    
                                <div class="mb-3">
                                    <label for="shortTerm_card_heading" class="form-label">Heading</label>
                                    <input type="text" class="form-control" id="shortTerm_card_heading" name="shortTerm_card_heading" value="{{$card->heading}}">
                                </div>
                                <div class="mb-3">
                                    <label for="shortTerm_card_image" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="shortTerm_card_image" name="shortTerm_card_image" >
                                </div>
                                <div class="mb-3">
                                    <label for="shortTerm_card_discription" class="form-label">Discription</label>
                                    <textarea class="form-control" id="shortTerm_card_discription" rows="3" name="shortTerm_card_discription">{{$card->detail}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="button" class="form-label">Button</label>
                                    <input type="text" class="form-control"  name="shortTerm_card_button" value="{{$card->button}}">
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
      <h5 class="mb-2">Short-Term Business Rentals Section</h5>
        <form action="{{route('admin.reservationshortTermBusiness')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="shortTerm_business_text" class="form-label">Detail</label>
                <textarea class="form-control ckeditor" id="shortTerm_business_text" rows="2" name="shortTerm_business_text">{{$shortTerm_banner->business_text}}</textarea>
            </div>
            <div class="mb-3">
                <label for="shortTerm_business_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="shortTerm_business_button" name="shortTerm_business_button" value="{{$shortTerm_banner->business_button}}">
            </div>
            <div class="mt-2">
                <label for="shortTerm_business_image" class="form-label">Image</label>
                <input class="form-control form-control-lg" id="shortTerm_business_image" name="shortTerm_business_image" type="file">
            </div>
            <img class="mt-2" id="shortTerm_business_blah" src="{{asset('images')}}/{{$shortTerm_banner->business_image ?? ''}}" style="width:50%;" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
  </div>
  <div class="tab-pane fade" id="subscribe" role="tabpanel" aria-labelledby="subscribe-tab">
    <div class="card p-4">
      <h5 class="mb-2">Banner Section</h5>
        <form action="{{route('admin.reservationSubscribe')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-2">
                <label for="subscribe_banner_image" class="form-label">Image</label>
                <input class="form-control form-control-lg" id="subscribe_banner_image" name="subscribe_banner_image" type="file">
            </div>
            <img class="mt-2" id="subscribe_banner_blah" src="{{asset('images')}}/{{$subscribe->banner_image ?? ''}}" style="width:50%;" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card p-4 mt-4">
      <h5 class="mb-2">Content Section</h5>
        <form action="{{route('admin.reservationContent')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="subscribe_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="subscribe_content" rows="2" name="subscribe_content">{{$subscribe->content}}</textarea>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="card p-4 mt-4">
      <h5 class="mb-2">Card Section</h5>
        <table id="" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Heading</th>
                    <th>Detail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscribe_cards as $s_card)
                <tr>
                    <td style="width:10%"><img src="{{asset('images/')}}/{{$s_card->image}}" alt=""></td>
                    <td>{{$s_card->heading}}</td>
                    <td>{{$s_card->detail}}</td>
                    <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subcard{{$s_card->id}}">Edit</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="subcard{{$s_card->id}}" tabindex="-1" aria-labelledby="subcardLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subcardLabel">Edit section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.reservationSubCard')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$s_card->id}}" name="sub_id">
                        <div class="modal-body">    
                            <div class="mb-3">
                                <label for="sub_heading" class="form-label">Heading</label>
                                <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="{{$s_card->heading}}">
                            </div>
                            <div class="mb-3">
                                <label for="sub_image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="sub_image" name="sub_image">
                            </div>
                            <div class="mb-3">
                                <label for="sub_discription" class="form-label">Discription</label>
                                <textarea class="form-control" id="sub_discription" rows="3" name="sub_discription">{{$s_card->detail}}</textarea>
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
      <h5 class="mb-2">How It Works</h5>
      <div class="mt-4">
            <form action="{{route('admin.reservationSubWorkheading')}}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" name="work_heading" id="work_heading" value="{{$subscribe->work_heading ?? ''}}">
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
      </div>
      <div class="mt-4">
          <table id="" class="table table-striped" style="width:100%">
             <thead>
                 <tr>
                     <th>Image</th>
                     <th>Heading</th>
                     <th>Detail</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($subscribe_works as $subscribe_work)
                 <tr>
                     <td style="width:10%"><img src="{{asset('images/')}}/{{$subscribe_work->image}}" alt=""></td>
                     <td>{{$subscribe_work->heading}}</td>
                     <td>{{$subscribe_work->detail}}</td>
                     <td><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subwork{{$subscribe_work->id}}">Edit</a></td>
                 </tr>
                 <!-- Modal -->
                 <div class="modal fade" id="subwork{{$subscribe_work->id}}" tabindex="-1" aria-labelledby="subworkLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="subworkLabel">Edit section</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form action="{{route('admin.reservationSubWork')}}" method="post" enctype="multipart/form-data">
                         @csrf
                         <input type="hidden" value="{{$subscribe_work->id}}" name="sub_work_id">
                         <div class="modal-body">    
                             <div class="mb-3">
                                 <label for="sub_work_heading" class="form-label">Heading</label>
                                 <input type="text" class="form-control" id="sub_work_heading" name="sub_work_heading" value="{{$subscribe_work->heading}}">
                             </div>
                             <div class="mb-3">
                                 <label for="sub_work_image" class="form-label">Image</label>
                                 <input class="form-control" type="file" id="sub_work_image" name="sub_work_image">
                             </div>
                             <div class="mb-3">
                                 <label for="sub_work_discription" class="form-label">Discription</label>
                                 <textarea class="form-control" id="sub_work_discription" rows="3" name="sub_work_discription">{{$subscribe_work->detail}}</textarea>
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
      <div class="mt-4">
            <form action="{{route('admin.reservationSubLink')}}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" name="link_heading" id="link_heading" value="{{$subscribe_link->heading ?? ''}}">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="link_heading1" id="link_heading1" value="{{$subscribe_link->heading1 ?? ''}}">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="link_heading2" id="link_heading2" value="{{$subscribe_link->heading2 ?? ''}}">
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
      </div>
    </div>
    <div class="card p-4 mt-4">
      <h5 class="mb-2">Last Section</h5>
        <form action="{{route('admin.reservationSubLastlink')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="subscribe_last_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="subscribe_last_content" rows="2" name="subscribe_last_content">{{$subscribe->last_content}}</textarea>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>
  
    </div>
</section>


<script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    window.onload = function() {
        CKEDITOR.replace('.ckeditor');
    };
    image.onchange = evt => {
        const [file] = image.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
    shortTerm_banner_image.onchange = evt => {
        const [file] = shortTerm_banner_image.files
        if (file) {
            shortTerm_banner_blah.src = URL.createObjectURL(file)
        }
    }
    subscribe_banner_image.onchange = evt => {
        const [file] = subscribe_banner_image.files
        if (file) {
            subscribe_banner_blah.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
