(function ($) {
    'use strict';

    if (! $) {
        return;
    }

    function initialiseCalendar() {
        if (! $.fn.daterangepicker || ! $('.cal').length) {
            return;
        }

        $('.cal').daterangepicker({
            opens: 'right',
            timePicker: true
        }, function (start, end) {
            var daysDiff = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

            localStorage.setItem('pickUp_Date', start.format('DD MMM, YYYY'));
            localStorage.setItem('pickUp_time', start.format('hh:mm A'));
            localStorage.setItem('return_Date', end.format('DD MMM, YYYY'));
            localStorage.setItem('return_time', end.format('hh:mm A'));
            localStorage.setItem('days', daysDiff);
            $('#pick_up_time').val(localStorage.getItem('pickUp_time'));
            $('#return_time').val(localStorage.getItem('return_time'));
        });
    }

    function restoreSelectedLocation() {
        var location = localStorage.getItem('location');

        if (! location) {
            return;
        }

        $('.selected_value').empty().append(location);
        $('#search').empty().val(location).hide();
        $('.selected_search').removeClass('d-none');
    }

    function restoreReservationSummary() {
        var location = localStorage.getItem('location');
        var pickupDate = localStorage.getItem('pickUp_Date');
        var pickupTime = localStorage.getItem('pickUp_time');
        var returnDate = localStorage.getItem('return_Date');
        var returnTime = localStorage.getItem('return_time');
        var age = localStorage.getItem('age');
        var vehicle = localStorage.getItem('vehicle');
        var totalPrice = localStorage.getItem('total_price');
        var type = localStorage.getItem('type');
        var selectedId = localStorage.getItem('vehicle_id');
        var extras = JSON.parse(localStorage.getItem('equipment') || '[]');

        $('.loc_name').empty().append(location || '');
        $('.pickup_time_date').empty().append([pickupDate, pickupTime].filter(Boolean).join(' '));
        $('.return_time_date').empty().append([returnDate, returnTime].filter(Boolean).join(' '));
        $('.selected_vehicle').empty().append(vehicle || '');
        $('.selectedVehicle').empty().append(location || '');
        $('.renter_age').empty().append(age || '');

        if (totalPrice !== null) {
            if (type === 'price') {
                var fixed = parseFloat(totalPrice).toFixed(2).split('.');

                $('.header-prise').removeClass('d-none');
                $('.header-points').addClass('d-none');
                $('.header_total_price').empty().append(fixed[0]);
                $('.afterDot').empty().append(fixed[1]);
                $('.append_checked_icon').empty().append('<img src="/images/checked.png" alt="checked">');
            } else {
                $('.header-prise').addClass('d-none');
                $('.header-points').removeClass('d-none');
                $('.header_total_points').empty().append(totalPrice);
            }
        }

        if (selectedId) {
            $('.btn-grid' + selectedId)
                .empty()
                .append('<button class="btn btn-secondary" disabled>Selected</button>');
        }

        extras.forEach(function (value) {
            $('.remove_equ' + value).removeClass('d-none');
            $('.add_equ' + value).addClass('d-none');
        });

        if (extras.length) {
            $('.selected_extras').empty().append(extras.length + ' Extras');
        }
    }

    function loadSelectedLocationAddress() {
        var location = localStorage.getItem('location');

        if (! location || ! $('.selected-loc-address').length) {
            return;
        }

        $.ajax({
            url: '/get-loc-address',
            data: { location: location },
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (! response || ! response.data) {
                    return;
                }

                $('.selected-loc-address')
                    .empty()
                    .text([response.data.location_name, response.data.address].filter(Boolean).join(' '));
            }
        });
    }

    $(function () {
        document.querySelectorAll('.dropdown-menu').forEach(function (element) {
            element.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });

        initialiseCalendar();
        restoreSelectedLocation();
        restoreReservationSummary();
        loadSelectedLocationAddress();
    });
})(window.jQuery);
