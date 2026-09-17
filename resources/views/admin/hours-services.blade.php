@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Hours & Services</h1>
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
    <div class="">
    <div class="card m-3 p-4">
        <form action="{{route('admin.policy.addHours')}}" method="post">
            @csrf
            <h6>Select Main Topic</h6>
            <select class="form-select" aria-label="Default select example" id="mainQuestion" name="location" required>
                <option value="">Select</option>
                @foreach($data as $loc)
                   <option value="{{$loc->id}}" >{{$loc->location_name}} ({{$loc->address}})</option>
                @endforeach
            </select> 
            <h6 class="my-4">Question/Answer</h6>
            <div class="card  p-4">
                <table id="" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Open Timing</th>
                            <th>Close Timing</th>
                            <th>Closed</th>
                            <th>24/7 Hours open</th>
                        </tr>
                    </thead>
                    <tbody id="policies_services">
                        <tr>
                            <td><input type="text"  name="sun_day" value="Sunday" readonly/></td>
                            <td><input type="time"  name="sun_open" /> <input type="time"  name="sun_open_2" /></td>
                            <td><input type="time"  name="sun_close" /> <input type="time"  name="sun_close_2" /></td>
                            <td>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" value="closed" name="sun_24_service" id="full_close">
                                <label class="form-check-label" for="full_close">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="24_hours" name="sun_24_service" id="24_hours1">
                                <label class="form-check-label" for="24_hours1">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="mon_day" value="Monday" readonly/></td>
                            <td><input type="time"  name="mon_open"   /> <input type="time"  name="mon_open_2"   /></td>
                            <td><input type="time"  name="mon_close"   /> <input type="time"  name="mon_close_2"   /></td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="closed" name="mon_24_service" id="full_close1">
                                <label class="form-check-label" for="full_close1">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="24_hours" name="mon_24_service" id="24_hours2">
                                <label class="form-check-label" for="24_hours2">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="tues_day" value="Tuesday" readonly/></td>
                            <td><input type="time"  name="tues_open"   /><input type="time"  name="tues_open_2"   /> </td>
                            <td><input type="time"  name="tues_close"   /><input type="time"  name="tues_close_2"   /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="closed" name="tues_24_service" id="full_close2">
                                <label class="form-check-label" for="full_close2">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="24_hours" name="tues_24_service" id="24_hours3">
                                <label class="form-check-label" for="24_hours3">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="wed_day" value="Wednesday" readonly/></td>
                            <td><input type="time"  name="wed_open"   /><input type="time"  name="wed_open_2"   /> </td>
                            <td><input type="time"  name="wed_close"   /><input type="time"  name="wed_close_2"   /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="closed" name="wed_24_service" id="full_close3">
                                <label class="form-check-label" for="full_close3">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="24_hours" name="wed_24_service" id="24_hours4">
                                <label class="form-check-label" for="24_hours4">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="thur_day" value="Thursday" readonly/></td>
                            <td><input type="time"  name="thur_open"   /><input type="time"  name="thur_open_2"   /> </td>
                            <td><input type="time"  name="thur_close"   /><input type="time"  name="thur_close_2"   /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="closed" name="thur_24_service" id="full_close4">
                                <label class="form-check-label" for="full_close4">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="24_hours" name="thur_24_service" id="24_hours5">
                                <label class="form-check-label" for="24_hours5">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="fri_day" value="Friday" readonly/></td>
                            <td><input type="time"  name="fri_open"   /><input type="time"  name="fri_open_2"   /> </td>
                            <td><input type="time"  name="fri_close"   /><input type="time"  name="fri_close_2"   /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="closed" name="fri_24_service" id="full_close5">
                                <label class="form-check-label" for="full_close5">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="24_hours" name="fri_24_service" id="24_hours6">
                                <label class="form-check-label" for="24_hours6">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="sat_day" value="Saturday" readonly/></td>
                            <td><input type="time"  name="sat_open"   /> <input type="time"  name="sat_open_2"   /></td>
                            <td><input type="time"  name="sat_close"   /><input type="time"  name="sat_close_2"   /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="closed" name="sat_24_service" id="full_close6">
                                <label class="form-check-label" for="full_close6">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="24_hours" name="sat_24_service" id="24_hours7">
                                <label class="form-check-label" for="24_hours7">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <button class="btn btn-primary" class="submit">Save</button>
                </div>
           </div>
        </form>
     </div>
    </div>
</section>
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
<script>
    new DataTable('#example');

 $('#mainQuestion').change(function () {
    let loc_id = $(this).val(); 
    $.ajax({
        type: "get",
        url: "{{route('admin.policy.showHours')}}",
        data: {
            "loc_id": loc_id
        },
        success: function (data) {
            var hours = jQuery.parseJSON(data.data.hours);
            if(hours.sun_24_service == 'Closed'){
                var checked = 'checked';
            }else if(hours.sun_24_service == 'Open 24/7'){
                var allday = 'checked';
            }else{
                var checked = '';
                var allday = '';
            }

            if(hours.mon_24_service == 'Closed'){
                var checked1 = 'checked';
            }else if(hours.mon_24_service == 'Open 24/7'){
                var allday1 = 'checked';
            }else{
                var checked1 = '';
                var allday1 = '';
            }

            if(hours.tues_24_service == 'Closed'){
                var checked2 = 'checked';
            }else if(hours.tues_24_service == 'Open 24/7'){
                var allday2 = 'checked';
            }else{
                var checked2 = '';
                var allday2 = '';
            }

            if(hours.wed_24_service == 'Closed'){
                var checked3 = 'checked';
            }else if(hours.wed_24_service == 'Open 24/7'){
                var allday3 = 'checked';
            }else{
                var checked3 = '';
                var allday3 = '';
            }

            if(hours.thur_24_service == 'Closed'){
                var checked4 = 'checked';
            }else if(hours.thur_24_service == 'Open 24/7'){
                var allday4 = 'checked';
            }else{
                var checked4 = '';
                var allday4 = '';
            }

            if(hours.fri_24_service == 'Closed'){
                var checked5 = 'checked';
            }else if(hours.fri_24_service == 'Open 24/7'){
                var allday5 = 'checked';
            }else{
                var checked5 = '';
                var allday5 = '';
            }

            if(hours.fri_24_service == 'Closed'){
                var checked5 = 'checked';
            }else if(hours.fri_24_service == 'Open 24/7'){
                var allday5 = 'checked';
            }else{
                var checked5 = '';
                var allday5 = '';
            }

            if(hours.sat_24_service == 'Closed'){
                var checked6 = 'checked';
            }else if(hours.sat_24_service == 'Open 24/7'){
                var allday6 = 'checked';
            }else{
                var checked6 = '';
                var allday6 = '';
            }
          
           $('#policies_services').html('');
         
                $('#policies_services').append(`    <tr>
                            <td><input type="text"  name="sun_day" value="Sunday" readonly/></td>
                            <td><input type="time"  name="sun_open" value="${hours.sun_open}"/> <input type="time"  name="sun_open_2" value="${hours.sun_open_2}"/></td>
                            <td><input type="time"  name="sun_close" value="${hours.sun_close}" /><input type="time"  name="sun_close_2" value="${hours.sun_close_2}" /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Closed" name="sun_24_service" ${checked}  id="full_close">
                                <label class="form-check-label" for="full_close">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Open 24/7" name="sun_24_service" ${allday} id="24_hours1">
                                <label class="form-check-label" for="24_hours1">
                                    24/7 Hours open
                                </label>
                                </div>
                                <span>clear</span>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="mon_day" value="Monday" readonly/></td>
                            <td><input type="time"  name="mon_open" value="${hours.mon_open}"  /><input type="time"  name="mon_open_2" value="${hours.mon_open_2}"  /> </td>
                            <td><input type="time"  name="mon_close" value="${hours.mon_close}"  /><input type="time"  name="mon_close_2" value="${hours.mon_close_2}"  /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Closed" name="mon_24_service" ${checked1} id="full_close1">
                                <label class="form-check-label" for="full_close1">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Open 24/7" name="mon_24_service" ${allday1} id="24_hours2">
                                <label class="form-check-label" for="24_hours2">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="tues_day" value="Tuesday" readonly/></td>
                            <td><input type="time"  name="tues_open" value="${hours.tues_open}"  /><input type="time"  name="tues_open_2" value="${hours.tues_open_2}"  /> </td>
                            <td><input type="time"  name="tues_close"  value="${hours.tues_close}" /><input type="time"  name="tues_close_2"  value="${hours.tues_close_2}" /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Closed" name="tues_24_service" ${checked2} id="full_close2">
                                <label class="form-check-label" for="full_close2">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Open 24/7" name="tues_24_service" ${allday2} id="24_hours3">
                                <label class="form-check-label" for="24_hours3">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="wed_day" value="Wednesday" readonly/></td>
                            <td><input type="time"  name="wed_open"  value="${hours.wed_open}" /><input type="time"  name="wed_open_2"  value="${hours.wed_open_2}" /> </td>
                            <td><input type="time"  name="wed_close" value="${hours.wed_close}"  /><input type="time"  name="wed_close_2" value="${hours.wed_close_2}"  /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Closed" name="wed_24_service" ${checked3} id="full_close3">
                                <label class="form-check-label" for="full_close3">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Open 24/7" name="wed_24_service" ${allday3} id="24_hours4">
                                <label class="form-check-label" for="24_hours4">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="thur_day" value="Thursday" readonly/></td>
                            <td><input type="time"  name="thur_open" value="${hours.thur_open}"  /><input type="time"  name="thur_open_2" value="${hours.thur_open_2}"  /> </td>
                            <td><input type="time"  name="thur_close" value="${hours.thur_close}"  /><input type="time"  name="thur_close_2" value="${hours.thur_close_2}"  /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Closed" name="thur_24_service"  ${checked4} id="full_close4">
                                <label class="form-check-label" for="full_close4">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Open 24/7" name="thur_24_service" ${allday4} id="24_hours5">
                                <label class="form-check-label" for="24_hours5">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="fri_day" value="Friday" readonly/></td>
                            <td><input type="time"  name="fri_open" value="${hours.fri_open}"  /><input type="time"  name="fri_open_2" value="${hours.fri_open_2}"  /> </td>
                            <td><input type="time"  name="fri_close" value="${hours.fri_close}"  /><input type="time"  name="fri_close_2" value="${hours.fri_close_2}"  /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Closed" name="fri_24_service" ${checked5} id="full_close5">
                                <label class="form-check-label" for="full_close5">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Open 24/7" name="fri_24_service" ${allday5} id="24_hours6">
                                <label class="form-check-label" for="24_hours6">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text"  name="sat_day" value="Saturday" readonly/></td>
                            <td><input type="time"  name="sat_open" value="${hours.sat_open}"  /><input type="time"  name="sat_open_2" value="${hours.sat_open_2}"  /> </td>
                            <td><input type="time"  name="sat_close"  value="${hours.sat_close}" /><input type="time"  name="sat_close_2"  value="${hours.sat_close_2}" /> </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Closed" name="sat_24_service" ${checked6} id="full_close6">
                                <label class="form-check-label" for="full_close6">
                                    Closed
                                </label>
                                </div>
                            </td>
                            <td><div class="form-check">
                                <input class="form-check-input" type="radio" value="Open 24/7" name="sat_24_service" ${allday6} id="24_hours7">
                                <label class="form-check-label" for="24_hours7">
                                    24/7 Hours open
                                </label>
                                </div>
                            </td>
                        </tr>
                `);
            
        }
    });
});
</script>
@endsection
