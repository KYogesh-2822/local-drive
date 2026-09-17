@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Jordan Vehicle</h1>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVechile">Add Vehicle</button>
    <div class="">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Model</th>
                <th>Transmission</th>
                <th>Features</th>
                <th>Passengers</th>
                <th>Bags</th>
                <th>Type</th>
                <th>Fuel Type</th>
                <th>Passengers</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $prod)
            <tr>
                <td><img src="{{asset('vehicles/')}}/{{$prod->image ?? ''}}" alt="" style="width:10rem;"></td>
                <td class="text-capitalize">{{$prod->vehicle ?? ''}}</td>
                <td>{{$prod->model ?? ''}}</td>
                <td>{{$prod->transmission ?? ''}}</td>
                <td>{{$prod->features ?? ''}}</td>
                <td>{{$prod->passengers}}</td>
                <td>{{$prod->bags}}</td>
                <td>{{$prod->type}}</td>
                <td>{{$prod->fuel_type}}</td>
                <td>{{$prod->passengers}}</td>
                <td><button class="btn-primary" data-bs-toggle="modal" data-bs-target="#editVechile{{$prod->id}}">Edit</button>
                <button class="btn-danger" onclick="deletePolicy({{$prod->id}})">Delete</button></td>
            </tr>

     
               <!-- Modal -->
            <div class="modal fade" id="editVechile{{$prod->id}}" tabindex="-1" aria-labelledby="editVechileLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editVechileLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.jodan.AddVechile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="prod_id" value="{{$prod->id}}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" value="{{$prod->image ?? ''}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="vehicle" class="form-label">Vehicle</label>
                                <input type="text" class="form-control" id="vehicle" name="vehicle" value="{{$prod->vehicle ?? ''}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model"  value="{{$prod->model ?? ''}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Transmission</label>
                                <input type="text" class="form-control" id="transmission" name="transmission" value="{{$prod->transmission ?? ''}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="feature" class="form-label">Features</label>
                                <textarea class="form-control" id="feature" rows="3" name="feature" required>{{$prod->features ?? ''}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Bags</label>
                                <select class="form-select" aria-label="Default select example" name="bags" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="1" {{$prod->bags == '1' ? 'selected' : ''}}>1</option>
                                    <option value="2" {{$prod->bags == '2' ? 'selected' : ''}}>2</option>
                                    <option value="3" {{$prod->bags == '3' ? 'selected' : ''}}>3</option>
                                    <option value="4" {{$prod->bags == '4' ? 'selected' : ''}}>4</option>
                                    <option value="5" {{$prod->bags == '5' ? 'selected' : ''}}>5</option>
                                    <option value="6" {{$prod->bags == '6' ? 'selected' : ''}}>6</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Vechicle type</label>
                                <select class="form-select" aria-label="Default select example" name="type" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="car" {{$prod->type == 'car' ? 'selected' : ''}}>Car</option>
                                    <option value="suv" {{$prod->type == 'suv' ? 'selected' : ''}}>SUV</option>
                                    <option value="vans" {{$prod->type == 'vans' ? 'selected' : ''}}>vans</option>    
                                    <option value="pickup" {{$prod->type == 'pickup' ? 'selected' : ''}}>Pick up</option>    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Fuel type</label>
                                <select class="form-select" aria-label="Default select example" name="fual_type" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="Gasoline" {{$prod->fuel_type == 'Gasoline' ? 'selected' : ''}}>Gasoline</option>
                                    <option value="Hybrid" {{$prod->fuel_type == 'Hybrid' ? 'selected' : ''}}>Hybrid</option>
                                    <option value="Diesel" {{$prod->fuel_type == 'Diesel' ? 'selected' : ''}}>Diesel</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Passengers</label>
                                <select class="form-select" aria-label="Default select example" name="passengers" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="1" {{$prod->passengers == '1' ? 'selected' : ''}}>1</option>
                                    <option value="2" {{$prod->passengers == '2' ? 'selected' : ''}}>2</option>
                                    <option value="3" {{$prod->passengers == '3' ? 'selected' : ''}}>3</option>
                                    <option value="4" {{$prod->passengers == '4' ? 'selected' : ''}}>4</option>
                                    <option value="5" {{$prod->passengers == '5' ? 'selected' : ''}}>5</option>
                                    <option value="6" {{$prod->passengers == '6' ? 'selected' : ''}}>6</option>
                                    <option value="7" {{$prod->passengers == '7' ? 'selected' : ''}}>7</option>
                                    <option value="8" {{$prod->passengers == '8' ? 'selected' : ''}}>8</option>
                                </select>
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
</section>
      <!-- Modal -->
      <div class="modal fade" id="addVechile" tabindex="-1" aria-labelledby="addVechileLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVechileLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('admin.jodan.AddVechile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image"  required>
                            </div>
                            <div class="mb-3">
                                <label for="vehicle" class="form-label">Vehicle</label>
                                <input type="text" class="form-control" id="vehicle" name="vehicle"  required>
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model"  required>
                            </div>
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Transmission</label>
                                <input type="text" class="form-control" id="transmission" name="transmission"  required>
                            </div>
                            <div class="mb-3">
                                <label for="feature" class="form-label">Features</label>
                                <textarea class="form-control" id="feature" rows="3" name="feature" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Bags</label>
                                <select class="form-select" aria-label="Default select example" name="bags" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Vechicle type</label>
                                <select class="form-select" aria-label="Default select example" name="type" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="car" >Car</option>
                                    <option value="suv" >SUV</option>
                                    <option value="vans" >vans</option>    
                                    <option value="pickup" >Pick up</option>    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Fuel type</label>
                                <select class="form-select" aria-label="Default select example" name="fual_type" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="Gasoline" >Gasoline</option>
                                    <option value="Hybrid" >Hybrid</option>
                                    <option value="Diesel" >Diesel</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Passengers</label>
                                <select class="form-select" aria-label="Default select example" name="passengers" required>
                                    <option value="" selected>Open this select menu</option>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
<style>
.form-select-sm {
    height: auto;
}
.form-control-sm {
    height: auto;
}
div#example_filter {
    float: right;
}
ul.pagination {
    float: right;
}
</style>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    new DataTable('#example');

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
                        url : "{{route('admin.jodan.deleteVechile')}}",
                        data : {'id':$id},
                        type : 'GET',
                        dataType : 'json',
                        success : function(response){
                         console.log(response);
                           $('.custom_success_message').html('');
                            if(response == 1){
                                $('.custom_success_message').append(` <div class="alert alert-success mt-2">Policy deleted succesfully. </div>`)
                                location.reload();
                            }   
                            
                        }
                    });
                }
            });
       }
</script>
@endsection
