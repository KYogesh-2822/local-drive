@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Vechiles</h1>
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
            <button class="nav-link active" id="car-tab" data-bs-toggle="tab" data-bs-target="#car" type="button" role="tab" aria-controls="car" aria-selected="true">Car</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="SUV-tab" data-bs-toggle="tab" data-bs-target="#SUV" type="button" role="tab" aria-controls="SUV" aria-selected="true">SUVs</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="truck-tab" data-bs-toggle="tab" data-bs-target="#truck" type="button" role="tab" aria-controls="truck" aria-selected="false">Trucks</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="minivans-vans-tab" data-bs-toggle="tab" data-bs-target="#minivans-vans" type="button" role="tab" aria-controls="minivans-vans" aria-selected="false">Minivans & Vans</button>
        </li>

    </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="car" role="tabpanel" aria-labelledby="car-tab">
      <div class="card p-3">
        <h5 class="mb-2">Banner Section</h5>
        <form action="{{route('admin.vehicle.carBaneer')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
                <label for="car_banner_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="car_banner_content" rows="1" name="car_banner_content">{{$car->banner_content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="car_banner_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="car_banner_button" name="car_banner_button" value="{{$car->banner_button ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="car_banner_image" class="form-label">Banner Image</label>
                <input class="form-control" type="file" id="car_banner_image"  name="car_banner_image">
            </div>
            <img class="mt-2" id="car_banner_blah" src="{{asset('images')}}/{{$car->banner_image ?? ''}}" style="width:50%;" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Section</h5>
        <form action="{{route('admin.vehicle.carContent')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="car_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="car_content" rows="1" name="car_content">{{$car->content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="car_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="car_button" name="car_button" value="{{$car->button ?? ''}}">
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
  </div>
  <div class="tab-pane fade " id="SUV" role="tabpanel" aria-labelledby="SUV-tab"> 
      <div class="card p-3">
        <h5 class="mb-2">Banner Section</h5>
        <form action="{{route('admin.vehicle.suvBaneer')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
                <label for="suv_banner_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="suv_banner_content" rows="1" name="suv_banner_content">{{$suv->banner_content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="suv_banner_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="suv_banner_button" name="suv_banner_button" value="{{$suv->banner_button ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="suv_banner_image" class="form-label">Banner Image</label>
                <input class="form-control" type="file" id="suv_banner_image"  name="suv_banner_image">
            </div>
            <img class="mt-2" id="suv_banner_blah" src="{{asset('images')}}/{{$suv->banner_image ?? ''}}" style="width:50%;" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Section</h5>
        <form action="{{route('admin.vehicle.suvContent')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="suv_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="suv_content" rows="1" name="suv_content">{{$suv->content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="suv_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="suv_button" name="suv_button" value="{{$suv->button ?? ''}}">
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
  </div>
  <div class="tab-pane fade " id="truck" role="tabpanel" aria-labelledby="truck-tab">
      <div class="card p-3">
        <h5 class="mb-2">Banner Section</h5>
        <form action="{{route('admin.vehicle.truckBaneer')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
                <label for="truck_banner_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="truck_banner_content" rows="1" name="truck_banner_content">{{$truck->banner_content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="truck_banner_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="truck_banner_button" name="truck_banner_button" value="{{$truck->banner_button ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="truck_banner_image" class="form-label">Banner Image</label>
                <input class="form-control" type="file" id="truck_banner_image"  name="truck_banner_image">
            </div>
            <img class="mt-2" id="truck_banner_blah" src="{{asset('images')}}/{{$truck->banner_image ?? ''}}" style="width:50%;" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Section</h5>
        <form action="{{route('admin.vehicle.truckContent')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="truck_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="truck_content" rows="1" name="truck_content">{{$truck->content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="truck_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="truck_button" name="truck_button" value="{{$truck->button ?? ''}}">
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
  </div>
  <div class="tab-pane fade" id="minivans-vans" role="tabpanel" aria-labelledby="minivans-vans-tab">
      <div class="card p-3">
        <h5 class="mb-2">Banner Section</h5>
        <form action="{{route('admin.vehicle.vanBaneer')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="mb-3">
                <label for="van_banner_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="van_banner_content" rows="1" name="van_banner_content">{{$van->banner_content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="van_banner_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="van_banner_button" name="van_banner_button" value="{{$van->banner_button ?? ''}}">
            </div>
            <div class="mb-3">
                <label for="van_banner_image" class="form-label">Banner Image</label>
                <input class="form-control" type="file" id="van_banner_image"  name="van_banner_image">
            </div>
            <img class="mt-2" id="van_banner_blah" src="{{asset('images')}}/{{$van->banner_image ?? ''}}" style="width:50%;" />
            <div class="mt-2">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
      </div>
      <div class="card p-3 mt-4">
        <h5 class="mb-2">Section</h5>
        <form action="{{route('admin.vehicle.vanContent')}}" method="post">
          @csrf
            <div class="mb-3">
                <label for="van_content" class="form-label">Content</label>
                <textarea class="form-control ckeditor" id="van_content" rows="1" name="van_content">{{$van->content ?? ''}}</textarea>
            </div>
            <div class="mb-3">
                <label for="van_button" class="form-label">Button</label>
                <input type="text" class="form-control" id="van_button" name="van_button" value="{{$van->button ?? ''}}">
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

    car_banner_image.onchange = evt => {
        const [file] = car_banner_image.files
        if (file) {
            car_banner_blah.src = URL.createObjectURL(file)
        }
    }
 
    suv_banner_content.onchange = evt => {
        const [file] = suv_banner_content.files
        if (file) {
            suv_banner_blah.src = URL.createObjectURL(file)
        }
    }

    truck_banner_image.onchange = evt => {
        const [file] = truck_banner_image.files
        if (file) {
            truck_banner_blah.src = URL.createObjectURL(file)
        }
    }

    van_banner_image.onchange = evt => {
        const [file] = van_banner_image.files
        if (file) {
            van_banner_blah.src = URL.createObjectURL(file)
        }
    }
 
</script>
@endsection
