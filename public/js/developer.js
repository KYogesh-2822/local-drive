// window.oncontextmenu = function () {
//     return false;
// };

// document.addEventListener("keydown", function(event){
//     var key = event.key || event.keyCode;

//     if (key == 123) {
//         return false;
//     } else if ((event.ctrlKey && event.shiftKey && key == 73) || (event.ctrlKey && event.shiftKey && key == 74)) {
//         return false;
//     }
// }, false);


// document.addEventListener('contextmenu', (e) => e.preventDefault());

// function ctrlShiftKey(e, keyCode) {
//   return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
// }

// document.onkeydown = (e) => {
//   // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
//   if (
//     event.keyCode === 123 ||
//     ctrlShiftKey(e, 'I') ||
//     ctrlShiftKey(e, 'J') ||
//     ctrlShiftKey(e, 'C') ||
//     (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
//   )
//     return false;
// };















//search location

$('#search').keyup(function(){
    var text = $(this).val();
    $.ajax({
        type: "get",
        url: "/autocomplete",
        data: {text:text},
        success: function(response){
            $('.locationFind').html('');
            $('.message').html('');
            if(response.data.length <= 0){
                $('.message').append(`<small>Sorry, we couldn't find any locations matching "${text}"
                                     Try searching using only a city name, ZIP or airport code.</small>`);
            }
            $.each(response.data, function (key, val) {
                $('.locationFind').append(` 
                    <ul class="address-list">
                        <li>
                            <h6>${val.location_name}<em>${val.address}</em></h6>
                            <a class="btn" onclick="select(${val.id})">Select</a>
                        </li>
                    </ul> `
                   );
                });
     
        }
    });
});


function select($id){
    var loc_id = $id;
    $.ajax({
        type: "get",
        url: "/select-location",
        data: {loc_id:loc_id},
        success: function(response){
            $('#search').val(response.name);
            $('.selected_value').html('');
            $('#search').hide();
            $('.selected_value').append(response.name);
            $('.selected_search').removeClass('d-none');
         
            $('#flush-collapseOne').removeClass("show");
        }
    });
}

function closeSelect(){
    $('#search').attr('value', '');  
    $('#search').show();
    $('.selected_search').addClass('d-none');
}

function getCurrent(){
    $.ajax({
        type: "get",
        url: "/get-ip",
        success: function(response){
            $('.selected_value').html('');
            $('#search').hide();
            $('#search').val(response.city);
            $('.selected_value').append(response.city);
            $('.selected_search').removeClass('d-none');
         
            $('#flush-collapseOne').removeClass("show");
        }
    });

}

function startReservation(){
    var search  =  $("#search").val();
    var rsearch  =  $("#return_search").val();
    var age  =  $("#age").val();

    if(rsearch){
        localStorage.setItem('return_location', rsearch);
    }
    $('#CustomErrorDiv').html('');
    if(!search){
        $('#CustomErrorDiv').append(`<div class="errorList">
        <ul >
            <li><span class="">Error: </span>
                <span id="">Sorry, we're not sure what location you are looking for. Please select a city or location from the drop-down or try searching again.</span>
            </li>
        </ul>
       </div>`);
     
    }else if(!age){
        $('#CustomErrorDiv').append(`<div class="errorList">
        <ul >
            <li><span class="">Error: </span>
                <span id="">Sorry, we're not sure what is your age.</span>
            </li>
        </ul>
       </div>`);
    }else if(!localStorage.getItem('pickUp_Date')){
        $('#time-date').modal('show');
    }else{
        var days = localStorage.getItem('days');
        localStorage.setItem('location', search);
        localStorage.setItem('age', age);
        localStorage.removeItem('vehicle');
        localStorage.removeItem('total_price');
        localStorage.removeItem('vehicle_id');
        localStorage.removeItem('type');
        localStorage.removeItem('days');
        window.location.href = "/car_select/"+days;
    }
}

// select car page filter
function updateLocation(){
    var new_loc = $('#search').val();
    localStorage.setItem('location', new_loc);
    location.reload();
 }



// return location 
$('#return_search').keyup(function(){
    var text = $(this).val();
    $.ajax({
        type: "get",
        url: "/autocomplete",
        data: {text:text},
        success: function(response){
            $('.locationFindReturn').html('');
            $('.messageReturn').html('');
            if(response.data.length <= 0){
                $('.messageReturn').append(`<small>Sorry, we couldn't find any locations matching "${text}"
                                     Try searching using only a city name, ZIP or airport code.</small>`);
            }
            $.each(response.data, function (key, val) {
                $('.locationFindReturn').append(` 
                    <ul class="address-list">
                        <li>
                            <h6>${val.location_name}<em>${val.address}</em></h6>
                            <a class="btn" onclick="selectReturn(${val.id})">Select</a>
                        </li>
                    </ul> `
                   );
                });
     
        }
    });
});

function selectReturn($id){
    var loc_id = $id;
    $.ajax({
        type: "get",
        url: "/select-location",
        data: {loc_id:loc_id},
        success: function(response){
            $('#return_search').val(response.name);
            $('.selected_value_return').html('');
            $('#return_search').hide();
            $('.selected_value_return').append(response.name);
            $('.selected_search_return').removeClass('d-none');
         
            $('#flush-collapseReturn').removeClass("show");
        }
    });
}

function closeSelectReturn(){
    $('#return_search').attr('value', '');  
    $('#return_search').show();
    $('.selected_search_return').addClass('d-none');
    localStorage.removeItem('location');
}


function getCurrentReturn(){
    $.ajax({
        type: "get",
        url: "/get-ip",
        success: function(response){
            $('.selected_value_return').html('');
            $('#return_search').hide();
            $('#return_search').val(response.city);
            $('.selected_value_return').append(response.city);
            $('.selected_search_return').removeClass('d-none');  
            $('#flush-collapseReturn').removeClass("show");
        }
    });

}

//select Vehicle
function selectVehicle(id,days,type) {
    $.ajax({
        url: "/add-vehicle",
        data: {
            id: id,
            days: days
        },
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {},
        success: function(response) {
            // console.log(response);
            var vehicle = response.data.vehicle;
            var price = parseFloat(response.data.price);
            var tax = parseFloat(response.data.tax);
            var total_price = (price*days)+tax;
            localStorage.setItem('vehicle', vehicle);
            localStorage.setItem('vehicle_id', id);
            localStorage.setItem('type',type);
            if(type == 'price'){
                localStorage.setItem('total_price', total_price);
            }else{
                localStorage.setItem('total_price', response.data.points);
            }
            localStorage.removeItem('equipment');
            window.location.href = "/extras/"+id;
        }
    });
}

//add equipments

function addEquipment(id){
    let array = JSON.parse(localStorage.getItem('equipment')) || [];
    array.push(id);
     $.ajax({
         url: "/add-equipment",
         data: {
             id: id,
             equ:array
         },
         type: 'GET',
         dataType: 'json',
         beforeSend: function() {},
         success: function(response) {
            $('.header_total_price').html('');
            $('.afterDot').html('');
             var vehicle = response.data.price;
             var total = localStorage.getItem('total_price');
             var t_price = parseFloat(vehicle) +  parseFloat(total);
             localStorage.setItem('total_price', t_price);
             localStorage.setItem('equipment', JSON.stringify(array));
             var totalprice = localStorage.getItem('total_price');
             var fixed = parseFloat(totalprice).toFixed(2);
             var substr = fixed.split('.');
             var beforedot = substr[0];
             var afterdot = substr[1];
             $('.header_total_price').append(beforedot);
             $('.afterDot').append(afterdot);
             $('.remove_equ'+id).removeClass('d-none');
             $('.add_equ'+id).addClass('d-none');

             if (array && array.length > 0) {
                $('.selected_extras').html('');
                $('.selected_extras').append(array.length+'Extras');
            }
         }
     });
 }

 
 function deleteEquipment(id){
    var array1 = JSON.parse(localStorage.getItem('equipment'));
    var removeItem = id;
    y = jQuery.grep(array1, function(value) {
      return value != removeItem;
    });

    $.ajax({
        url: "/add-equipment",
        data: {
            id: id,
        },
        type: 'GET',
        dataType: 'json',
        beforeSend: function() {},
        success: function(response) {
            $('.header_total_price').html('');
            $('.afterDot').html('');
            var vehicle = response.data.price;
            var total = localStorage.getItem('total_price');
            var t_price = parseFloat(total) - parseFloat(vehicle);
            localStorage.setItem('total_price', t_price);
            localStorage.setItem('equipment', JSON.stringify(y));
            // location.reload();
            var totalprice = localStorage.getItem('total_price');
            var fixed = parseFloat(totalprice).toFixed(2);
            var substr = fixed.split('.');
            var beforedot = substr[0];
            var afterdot = substr[1];
            $('.header_total_price').append(beforedot);
            $('.afterDot').append(afterdot);
            $('.remove_equ'+id).addClass('d-none');
            $('.add_equ'+id).removeClass('d-none');

            $('.selected_extras').html('');
            var equ = JSON.parse(localStorage.getItem('equipment'));
            if (equ && equ.length > 0) {
                $('.selected_extras').append(equ.length+'Extras');
            }
        }
    });
 
}

$(document).ready(function() {
    $('.ad_date_time').click(function(){
        $('.date_time_form').removeClass('d-none');
        $('.date_time_msg').addClass('d-none');
    });
});



