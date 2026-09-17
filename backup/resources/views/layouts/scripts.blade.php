<!-- jQuery first, then Project JS. -->
<script src="{{asset('js/bundle.min.js')}}"></script>
<script src="{{asset('js/ProjectName.js')}}"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="{{asset('js/language.js')}}"></script>
<script src="{{asset('js/developer.js')}}"></script>
<script src="{{asset('js/reservation.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>




<script type="text/javascript">
    var dates = [];
    // $(document).ready(function() {
    //     $(".cal").daterangepicker();
    //     $(".cal").on('apply.daterangepicker', function(e, picker) {
    //         e.preventDefault();
    //         const obj = {
    //             "key": dates.length + 1,
    //             "start": picker.startDate.format('dd/M/yyy'),
    //             "end": picker.endDate.format('MM/DD/YYYY')
    //         }
    //         dates.push(obj);
    //         showDates();
    //     })
    //     $(".remove").on('click', function() {
    //         removeDate($(this).attr('key'));
    //     })
    // })
    $(function() {
        $('.cal').daterangepicker({
            opens: 'right',
            timePicker: true,
        }, function(start, end, label) { 
            var time = start.format('hh:mm A'); //get time
            var daysDiff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); // get days
            // console.log("A new date selection was made: " + start.format('D MMM YYYY hh:mm A') + ' to ' + end.format('D MMM YYYY hh:mm A'));
            localStorage.setItem('pickUp_Date', start.format('DD MMM, YYYY'));
            localStorage.setItem('pickUp_time', start.format('hh:mm A'));
            localStorage.setItem('return_Date', end.format('DD MMM, YYYY'));
            localStorage.setItem('return_time', end.format('hh:mm A'));
            localStorage.setItem('days', daysDiff);
            var pickup = localStorage.getItem('pickUp_Date');
            var pickup_t = localStorage.getItem('pickUp_time');
            var return_t = localStorage.getItem('return_time');
            $('#pick_up_time').val(pickup_t);
            $('#return_time').val(return_t);
        });
    });


    $( document ).ready(function() {
        var loc = localStorage.getItem("location");
        if (loc != null) {
            $('.selected_value').html('');
            $('#search').html('');
            $('#search').val(loc);
            $('.selected_value').append(loc);
            $('#search').hide();
            $('.selected_search').removeClass('d-none');
        }
    });

    //show show date time location in the header
    $(document).ready(function() {
        $('.loc_name').html('');
        $('.pickup_time_date').html('');
        $('.return_time_date').html('');
        $('.selected_vehicle').html('');  
        $('.selectedVehicle').html('');
        $('.renter_age').html('');
        var loc = localStorage.getItem('location');
        var p_date = localStorage.getItem('pickUp_Date');
        var p_time = localStorage.getItem('pickUp_time');
        var r_date = localStorage.getItem('return_Date');
        var r_time = localStorage.getItem('return_time');
        var age = localStorage.getItem('age');
        var a = localStorage.getItem('vehicle');
        var totalprice = localStorage.getItem('total_price');
        var type = localStorage.getItem('type');
        if(totalprice != null){
            if(type == 'price'){
                $('.header-prise').removeClass('d-none');
                $('.header-points').addClass('d-none');
                $('.header_total_price').html('');
                $('.afterDot').html('');
                $('.append_checked_icon').html('');  
                var fixed = parseFloat(totalprice).toFixed(2);
                var substr = fixed.split('.');
                var beforedot = substr[0];
                var afterdot = substr[1];
                $('.header_total_price').append(beforedot);
                $('.afterDot').append(afterdot);
                $('.append_checked_icon').append(`<img src="{{asset('images/checked.png')}}" alt="checked">`);
            }else{
                $('.header_total_points').html('');
                $('.header-prise').addClass('d-none');
                $('.header-points').removeClass('d-none');
                $('.header_total_points').append(totalprice);
            }
        }
        $('.renter_age').append(age);
        $('.loc_name').append(loc);
        $('.pickup_time_date').append(p_date + " " +p_time);
        $('.return_time_date').append(r_date + " " +r_time);
        $('.selected_vehicle').append(a);

        var seleted_id =  localStorage.getItem('vehicle_id');
        $('.btn-grid'+seleted_id).html('');
        $('.btn-grid'+seleted_id).append(`<button class="btn btn-secondary" disabled>Seleted</button>`);

        $('.selectedVehicle').append(loc);   
        var extras = JSON.parse(localStorage.getItem('equipment')) || [];  // EXTRAS ADD-REMOVE
            $.each(extras, function (key, val) {
                $('.remove_equ'+val).removeClass('d-none');
                $('.add_equ'+val).addClass('d-none');
            });

            if (extras && extras.length > 0) {
                $('.selected_extras').html('');
                $('.selected_extras').append(extras.length+'Extras');
            }
    });

    $(document).ready(function() {
        var location = localStorage.getItem("location");
        $.ajax({
         url: "/get-loc-address",
         data: {
             location: location
         },
         type: 'GET',
         dataType: 'json',
         beforeSend: function() {},
         success: function(response) {
            // console.log(response);
            $('.selected-loc-address').html('');
            $('.selected-loc-address').append(response.data.location_name +' '+ response.data.address);
         }
       });
    });


    
</script>