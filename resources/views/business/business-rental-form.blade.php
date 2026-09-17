@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('business.carRental')}}">Business Car Rental</a></li>
                <li><a href="#">Business Rental Form</a></li>
            </ul>
        </div>
    </div>
    <section class="rental_section">
        <h1 class="visually-hidden">Business Car Rental Enquiry</h1>
        <div class="content_image">
            <div class="content">
                {!! $data->business_form_content !!}
                <!-- <h2>Two great brands. One global business rental solution.</h2>
                <p>Enterprise Rent-A-Car® and National Car Rental® are two great brands that give your company's
                    travellers everything they need when renting a car. Enterprise is the first choice for business
                    travellers who prefer the convenience of renting near their office or home while also enjoying very
                    competitive rates. Frequent renters at airports choose National for the speed and choice it offers
                    them, plus the Emerald Club programme lets members bypass the counter and get on their way faster.
                    Enterprise customers can also earn Emerald Club credits at participating locations. No matter which
                    you choose, your business receives great service, value and convenience — and the most comprehensive
                    business rental solution in the marketplace — from two brands astute travellers know and trust.</p>
                <p>Please fill out the form below and we would be happy to speak with you about your business rental
                    needs.</p> -->
            </div>
            <div class="image">
                <figure>
                    <img src="{{asset('images/')}}/{{$data->business_form_image}}"
                        alt="image">
                </figure>
            </div>
        </div>

        <div class="form">
            <div class="form basic-form" id="js-basic-form">
                <form method="POST" id="businessRentalForm">
                   @csrf

                    <div class="componentsgrouping section">
                        <fieldset>
                            <h6>* Indicates Required Field</h6>
                            <legend>Primary Contact Information</legend>
                            <br>
                            <span></span>
                            <div>
                                <div class="text section">
                                    <div class="form_row ">
                                        <div class="form_leftcol">
                                            <div class="form_leftcollabel">
                                                <label for="contact-name">Primary Contact Name </label></div>
                                            <div class="form_leftcolmark"> *</div>
                                        </div>

                                        <div class="form_rightcol" id="primary-contact-name_rightcol">
                                            <div id="primary-contact-name_0_wrapper" class="form_rightcol_wrapper">
                                                <input class="form_field form_field_text" id="contact-name" name="name" value="" size="35">
                                                <div class="error-message" id="name-error" style="color: #dc3545; font-size: 13px; margin-top: 5px; display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_row_description"></div>

                                </div>
                                <div class="ghost section">

                                </div>
                                <div class="text section">
                                    <div class="form_row ">
                                        <div class="form_leftcol">
                                            <div class="form_leftcollabel">
                                                <label for="contact_email">Email address</label></div>
                                            <div class="form_leftcolmark"> *</div>
                                        </div>

                                        <div class="form_rightcol" id="primary_contact_email_field_rightcol">
                                            <div id="primary_contact_email_field_0_wrapper" class="form_rightcol_wrapper">
                                                <input class="form_field form_field_text" id="contact_email" name="email" value="" size="35">
                                                <div class="error-message" id="email-error" style="color: #dc3545; font-size: 13px; margin-top: 5px; display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_row_description"><span>We will only use your email address to
                                            contact you regarding your business rental needs.</span></div>

                                </div>
                                <div class="text section">
                                    <div class="form_row ">
                                        <div class="form_leftcol">
                                            <div class="form_leftcollabel">
                                                <label for="contact_phone">Phone number</label></div>
                                            <div class="form_leftcolmark"> *</div>
                                        </div>

                                        <div class="form_rightcol" id="primary_contact_phone_rightcol">
                                            <div id="primary_contact_phone_0_wrapper" class="form_rightcol_wrapper">
                                                <input class="form_field form_field_text" id="contact_phone" name="phone" value="" size="1">
                                                <div class="error-message" id="phone-error" style="color: #dc3545; font-size: 13px; margin-top: 5px; display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_row_description"><span>Please include country code</span></div>

                                </div>
                                <div class="text section">
                                    <div class="form_row ">
                                        <div class="form_leftcol">
                                            <div class="form_leftcollabel">
                                                <label for="contect-vehicle-type">Type of vehicle</label>
                                            </div>
                                            <div class="form_leftcolmark"> *</div>
                                        </div>

                                        <div class="form_rightcol" id="rental_needs_rightcol">
                                            <div id="rental_needs_0_wrapper" class="form_rightcol_wrapper">
                                                <input class="form_field form_field_text" id="contect-vehicle-type" name="type" value="" size="35">
                                                <div class="error-message" id="type-error" style="color: #dc3545; font-size: 13px; margin-top: 5px; display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_row_description"></div>

                                </div>
                                <div class="text section">
                                    <div class="form_row ">
                                        <div class="form_leftcol">
                                            <div class="form_leftcollabel">
                                                <label for="contect-date">Dates</label></div>
                                            <div class="form_leftcolmark"> *</div>
                                        </div>

                                        <div class="form_rightcol" id="rental_needs_rightcol">
                                            <div id="rental_needs_0_wrapper" class="form_rightcol_wrapper">
                                                <input class="form_field form_field_text" id="contect-date" name="date" value="" size="35">
                                                <div class="error-message" id="date-error" style="color: #dc3545; font-size: 13px; margin-top: 5px; display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_row_description"></div>

                                </div>

                            </div>
                        </fieldset>
                    </div>
                    <div class="submit section">

                        <div class="form_row">
                            <div class="form_leftcol">
                                <div class="form_leftcollabel"><span>&nbsp;</span></div>
                                <div class="form_leftcolmark">&nbsp;</div>
                            </div>

                            <div class="form_rightcol">
                                <button type="submit" class="cta cta--primary cta--large" id="submitBtn">Submit</button>
                            </div>
                        </div>
                        <div class="form_row_description"></div>

                    </div>

                </form>
            </div>

            <p>Read our <a href="{{route('privacy_policy')}}">privacy policy</a> for more information. If you have any questions, please <a
                    href="{{route('customer.contact')}}">contact us</a>.</p>
        </div>
    </section>
</main>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('businessRentalForm').addEventListener('submit', function(e) {
    e.preventDefault();
   
    // Clear previous errors
    clearErrors();

    // Get form data
    var formData = new FormData(this);

    // Disable button and show loading
    var btn = document.getElementById('submitBtn');
    var originalText = btn.innerHTML;
    btn.innerHTML = 'Submitting...';
    btn.disabled = true;

    // Get CSRF token
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send AJAX request
    fetch('{{ route("business.businessFormAjax") }}', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json().then(data => ({status: response.status, body: data})))
    .then(({status, body}) => {
        btn.innerHTML = originalText;
        btn.disabled = false;

        if (body.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: body.message,
                confirmButtonColor: '#007041'
            });

            document.getElementById('businessRentalForm').reset();

        } else {
            if (body.errors) {
                showErrors(body.errors);
            } else if (body.message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: body.message,
                    confirmButtonColor: '#dc3545'
                });
            }
        }
    })
    .catch(error => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong. Please try again.',
            confirmButtonColor: '#dc3545'
        });
        console.error('Error:', error);
    });
});


function clearErrors() {
    var fields = ['name', 'email', 'phone', 'type', 'date'];
    fields.forEach(function(field) {
        var errorDiv = document.getElementById(field + '-error');
        if (errorDiv) {
            errorDiv.style.display = 'none';
            errorDiv.innerHTML = '';
        }
    });
    // Remove is-invalid class from all inputs
    document.querySelectorAll('.form_field').forEach(function(input) {
        input.classList.remove('is-invalid');
    });
}

function showErrors(errors) {
    for (var field in errors) {
        var errorDiv = document.getElementById(field + '-error');
        if (errorDiv) {
            errorDiv.innerHTML = errors[field][0];
            errorDiv.style.display = 'block';
        }
        // Add red border to input
        var input = document.querySelector('[name="' + field + '"]');
        if (input) {
            input.classList.add('is-invalid');
        }
    }
}
</script>

<style>
.form_field.is-invalid {
    border-color: #dc3545 !important;
}
</style>

@endsection
