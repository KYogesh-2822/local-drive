 @extends('layouts.main')

@section('content')
<main class="content">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li>Enterprise Plus Account</li>
            </ul>
        </div>
    </div>

    <section class="sec-p pb-5 heading-txt-sec">
        <div class="container">
            <div class="row">
                <div class="ul-dot col-lg-9">
                    <div class="txt">
                        <h1 class="mb-3">Create Your Enterprise Plus Account</h1>
                        <b><em>*Required to complete your enrollment</em></b>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="sec-p pt-0 form-accordian">
        <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <form action="{{route('enterprise.create')}}" method="post" class="myProfile">
            @csrf
            <div class="accordion " id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="true" aria-controls="">
                                <span>1</span> My Profile
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse  show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body  " id="display1">
                                <div class="form">
                                  
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">First Name<sup>*</sup></label>
                                                    <input type="text" class="form-control " name="name" id="name" >
                                                    <div id="errorFirstName" class="text-danger"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Last Name<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="lastName" id="lastName">
                                                    <div id="errorLastName" class="text-danger"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Email Address<sup>*</sup></label>
                                                    <input type="email" class="form-control" name="email" id="email">
                                                    <div id="emailError" class="text-danger"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Confirm Email Address<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="confirmEmail" id="confirmEmail">
                                                    <div id="confirmEmailError" class="text-danger"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Password<sup>*</sup></label>
                                                    <input type="password" class="form-control" name="password" id="password">
                                                    <span id="password-toggle" onclick="togglePasswordVisibility()">Show</span>
                                                </div>
                                                <div id="passwordError" class="text-danger"></div>
                                                <ul class="mb-3">
                                                    <li class="length_val">Must be at least 8 characters</li>
                                                    <li class="latter_val">Must contain a letter</li>
                                                    <li class="num_val">Must contain a number</li>
                                                    <li class="word_val">Can't contain the word "password"</li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Confirm Password<sup>*</sup></label>
                                                    <input type="password" class="form-control" name="c_password" id="c_password">
                                                </div>
                                                <div id="c_passwordError" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="btn-grid text-end">
                                                    <a class="btn"  id="profile_save">Continue</a>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>                
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed contactcollapse2 " type="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="">
                                <span>2</span> Contact Details
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse  contactcollapse2" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body showAccordian"  id="display2">
                             <!-- <form  id="contactdetail"> -->
                                <div class="form">
                               
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Country of Residence<sup>*</sup></label>
                                                    <select class="form-select" aria-label="Default select example" name="residence" id="residence">
                                                        <option selected value="111">Jordan</option>
                                                    </select>
                                                    <div id="errorResidence" class="text-danger"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Street Address 1<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="address1" id="address1">
                                                </div>
                                                <div id="errorAddress1" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Street Address 2 (Optional)<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="address2" id="address2">
                                                </div>
                                                <div id="errorAddress2" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">City<sup>*</sup></label>
                                                    <input type="text" class="form-control" name="city" id="city">
                                                </div>
                                                <div id="errorCity" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">State<sup>*</sup></label>
                                                    <select class="form-select" aria-label="Default select example" name="state" id="state">
                                                        <option value="" selected>Select</option>
                                                        @foreach($states as $state)
                                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div id="errorState" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">ZIP Code<sup>*</sup></label>
                                                    <input type="number" class="form-control" name="zipCode" id="zipCode">
                                                </div>
                                                <div id="errorZipCode" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Primary Phone Number<sup>*</sup></label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected value="Home">Home</option>
                                                        <option value="Work">Work</option>
                                                        <option value="Mobile">Mobile</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div id="error" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two" style="display: none;">Phone</label>
                                                    <input type="number" class="form-control" name="phone"  pattern="[0-9]+"  id="phone">
                                                </div>
                                                <div id="errorPhone" class="text-danger" style="margin-top: 35px;"></div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two">Alternate Phone Number (Optional)</label>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected value="Home">Home</option>
                                                        <option value="Work">Work</option>
                                                        <option value="Mobile">Mobile</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div id="errorFirstName" class="text-danger"></div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label class="form-label form-label-two" style="display: none;">Phone</label>
                                                    <input type="number" class="form-control" name="alterPhone"  pattern="[0-9]+"  id="telephone">
                                                </div>
                                                <div id="errorAlterPhone" class="text-danger" style="margin-top: 35px;"></div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="btn-grid text-end">
                                                    <a class="btn" id="content_detail">Continue</a>
                                                </div>
                                            </div>
                                        </div>
                                  
                                </div>
                             <!-- </form> -->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="">
                                <span>3</span> Driver's License Details
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse " aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body showAccordian" id="display3">
                                <div class="form">    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label form-label-two">Issuing Country<sup>*</sup></label>
                                                <select class="form-select" aria-label="Default select example" name="issuingCountry" id="issuingCountry">
                                                    <option selected value="">Select</option>
                                                    @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div id="errorIssuingCountry" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 stateAuthority">
                                            <div class="form-group">
                                                <label class="form-label form-label-two">Issuing Authority<sup>*</sup></label>
                                                <select class="form-select" aria-label="Default select example" name="issuingAuthority" id="issuingAuthority">
                                                    <option selected value="">Select Issuing Country first</option>
                                                </select>
                                                <div id="errorIssuingAuthority" class="text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label class="form-label form-label-two">Birth Date(MM/DD/YYYY)<sup>*</sup></label>
                                                <div class="date-grid d-flex">
                                                    <input type="number" class="form-control" placeholder="MM" maxlength="2" name="birthMonth" id="birthMonth">
                                                    <input type="number" class="form-control" placeholder="DD" maxlength="2" name="birthDate" id="birthDate">
                                                    <input type="number" class="form-control" placeholder="YY" maxlength="4" name="birthYear" id="birthYear">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="errordob" class="text-danger"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label class="form-label form-label-two">Driver's License Number<sup>*</sup></label>
                                                <input type="text" class="form-control" name="licenseNumber" id="licenseNumber">
                                            </div>
                                        </div>
                                        <div id="errorlicenseNumber" class="text-danger"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label class="form-label form-label-two">Expiration Date(MM/DD/YYYY)<sup>*</sup></label>
                                                <div class="date-grid d-flex">
                                                    <input type="number" class="form-control" placeholder="MM" maxlength="2" name="expMonth" id="expMonth">
                                                    <input type="number" class="form-control" placeholder="DD" maxlength="2"  name="expDate" id="expDate">
                                                    <input type="number" class="form-control" placeholder="YY" maxlength="4" name="expYear" id="expYear">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="errorExpiration" class="text-danger"></div>
                                    </div>
                                    <div class="btn-grid text-end">
                                        <a class="btn" id="license_detail">Continue</a>  
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingfour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="">
                                <span>4</span> Preferences
                            </button>
                        </h2>
                        <div id="collapsefour" class="accordion-collapse " aria-labelledby="headingfour" data-bs-parent="#accordionExample">
                            <div class="accordion-body showAccordian" id="display4">
                                <!-- <form class="term-condition"> -->
                                <div class="form">
                                    <h3>Email Specials (Optional)</h3>                                
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="emailSpecial">
                                                        <label class="form-check-label" for="exampleCheck1">Sign up for Enterprise Email Specials</label>
                                                    </div>
                                                </div>
                                                <p>By selecting this box, you would like to receive email promotions and offers from Enterprise Rent-A-Car. Note that your email interactions can be used to perform analytics and produce content & ads tailored to your interests. Please understand that there is no charge and that you can unsubscribe at any time by (i) using the links provided in the emails, (ii) managing your preferences in your Enterprise Plus profile or (iii) contacting us. Please consult our <a class="btn-txt d-inline-block" href="#">Privacy Policy</a> and our <a class="btn-txt d-inline-block" href="#">Cookie Policy</a> to find out more.</p>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="accept_condition" name="accept_condition">
                                                        <label class="form-check-label" for="accept_condition">I have read and accept <a class="btn-txt d-inline-block" href="#">Enterprise Plus Terms & Conditions <sup>*</sup></a></label>
                                                    </div>
                                                </div>
                                                <div id="errorTermCondition" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="btn-grid text-end">
                                            <button class="btn" type="submit" id>Create Account</button>
                                        </div>
                                   </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
       
            </form>
        </div>
    </section>
</main>
<style>
.error {
    color: red;
}
.accordion-body.showAccordian{
    display: none;
}
</style>
<link rel="stylesheet" href="{{asset('build/css/intlTelInput.css')}}">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-latest.min.js"></script> -->
<script src="{{asset('build/js/intlTelInput-jquery.min.js')}}"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>




<script>


$("#telephone").intlTelInput({
    showSelectedDialCode:true,

});
$("#phone").intlTelInput({
    showSelectedDialCode:true
});
function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var passwordToggle = document.getElementById("password-toggle");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordToggle.textContent = "Hide";
    } else {
      passwordInput.type = "password";
      passwordToggle.textContent = "Show";
    }
  }
    //Select country first
    $('select[name="issuingCountry"]').on('change', function() {
        var countryId = $(this).val();
        $.ajax({
            type: "get",
            url: "{{route('enterprise.getState')}}",
            data: {country : countryId },
            success: function (data) {
                if(data.status == 'success'){
                    if((data.states).length <= 0){
                       $('.stateAuthority').hide();
                    }else{
                        $('.stateAuthority').show();
                    }
                    $('#issuingAuthority').html('');
                    $.each(data.states, function(k, v) {
                        $('#issuingAuthority').append(` <option value="${v.id}">${v.name}</option>`);
                    });                
                }
            }
        });
    });

    //EMAIL VALIDATION
    $("#email, #confirmEmail").on("keyup", function () {    
       validateEmails();
    });

    function validateEmails() {
        var email = $("#email").val();
        var confirmEmail = $("#confirmEmail").val();

        // Clear previous error messages
        $("#emailError").text("");
        $("#confirmEmailError").text("");
        // Check if email is empty

        if (email === "") {
            $("#emailError").text("Email is required");
        } else if (!isValidEmail(email)) {
            $("#emailError").text("Invalid email address");
        }

        // Check if confirm email is empty
        if (confirmEmail === "") {
            $("#confirmEmailError").text("Confirm Email is required");
        } else if (email !== confirmEmail) {
            $("#confirmEmailError").text("Email addresses do not match");
        }
      
    }

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }



    //password validation 
      $("#password, #c_password").on("keyup", function () {
        validatePasswords();
      });

      function validatePasswords() {
        var password = $("#password").val();
        var c_password = $("#c_password").val();
        $("#passwordError").text("");
        $("#c_passwordError").text("");

        // Check if password meets criteria
        // if (password.length < 8) {
        //   $("#passwordError").text("Password must be at least 8 characters");
        // } else if (!/[a-zA-Z]/.test(password)) {
        //   $("#passwordError").text("Password must contain a letter");
        // } else if (!/\d/.test(password)) {
        //   $("#passwordError").text("Password must contain a number");
        // } else if (password.toLowerCase().includes("password")) {
        //   $("#passwordError").text("Password can't contain the word 'password'");
        // }

        if (password.length < 8) {
            $('.length_val').css('color', 'red');
        }else{
            $('.length_val').css('color', 'green');
        }
        
        if (!/[a-zA-Z]/.test(password)) {
            $('.latter_val').css('color', 'red');
        }else{
            $('.latter_val').css('color', 'green');
        }
       
         if (!/\d/.test(password)) {
            $('.num_val').css('color', 'red');
        }else{
            $('.num_val').css('color', 'green');
        }
        
        if (password.toLowerCase().includes("password")) {
            $('.word_val').css('color', 'red');
        }else{
            $('.word_val').css('color', 'green');
        }

        // Check if confirm password matches password
        if (c_password !== password) {
          $("#c_passwordError").text("Passwords do not match");
        }
      }

      function step1(){
        var fname = $('#name').val();
        var lname = $('#lastName').val();
        var email = $('#email').val();
        var confirmEmail = $('#confirmEmail').val();
        var password = $('#password').val();
        var c_password = $('#c_password').val();
            if(fname.length === 0 ){
                $("#errorFirstName").text("This field is required.");
            }
            if(lname.length === 0 ){
                $("#errorLastName").text("This field is required.");
            }
            if(email.length === 0 ){
                $("#emailError").text("This field is required.");
            }
            if(confirmEmail.length === 0 ){
                $("#confirmEmailError").text("This field is required.");
            }
            if(password.length === 0 ){
                $("#passwordError").text("This field is required.");
            }
            if(c_password.length === 0 ){
                $("#c_passwordError").text("This field is required.");
            }
            if(email != confirmEmail){
            $("#emailError").text(" Email addresses do not match.");
            }
            if(password != c_password){
                $("#passwordError").text("Password do not match.");
            }
      }

      $("#profile_save").on("click", function (event) {

        validatePasswords();
        step1();
        var fname = $('#name').val();
        var lname = $('#lastName').val();
        var email = $('#email').val();
        var confirmEmail = $('#confirmEmail').val();
        var password = $('#password').val();
        var c_password = $('#c_password').val();
        // Prevent form submission if there are validation errors
        if ($("#passwordError").text() !== "" || $("#confirmPasswordError").text() !== "") {
          event.preventDefault();
        }

        if(fname != '' && lname != '' && email != '' && password != '' && email == confirmEmail && password == c_password){
            $("#display2").removeClass("showAccordian");
            $("#collapseOne").removeClass("show");
            $("#display1").addClass("showAccordian");
            $("#collapseTwo").addClass("show");
        }
      });

    // keyup
    $("#name, #lastName, #email, #password, #residence, #address1, #city, #state, #zipCode, #phone, #issuingCountry, #issuingAuthority, #birthMonth, #birthDate, #birthYear, #licenseNumber, #expMonth, #expDate, #expYear").on("keyup", function () {
        $("#errorFirstName").text("");
        $("#errorLastName").text("");
        $("#passwordError").text("");
        $("#c_passwordError").text("");
        $("#errorResidence").text("");
        $("#errorAddress1").text("");
        $("#errorCity").text("");
        $("#errorState").text("");
        $("#errorZipCode").text("");
        $("#errorPhone").text("");
        $("#errorIssuingCountry").text("");
        $("#errorIssuingAuthority").text("");
        $("#errordob").text("");
    });

    // $('#profile_save').click(function(){
    //     var fname = $('#name').val();
    //     var lname = $('#lastName').val();
    //     var email = $('#email').val();
    //     var confirmEmail = $('#confirmEmail').val();
    //     var password = $('#password').val();
    //     var c_password = $('#c_password').val();
    //     if(fname != '' && lname != '' && email != '' && password != '' && email == confirmEmail && password == c_password){
    //         $("#display2").removeClass("showAccordian");
    //         $("#collapseOne").removeClass("show");
    //         $("#display1").addClass("showAccordian");
    //         $("#collapseTwo").addClass("show");
    //     }else if(email != confirmEmail){
    //         $("#emailError").text(" Email addresses do not match.");
    //     }else if(password != c_password){
    //         $("#passwordError").text("Password do not match.");
    //     }else{
    //         if(fname.length === 0 ){
    //             $("#errorFirstName").text("This field is required.");
    //         }
    //         if(lname.length === 0 ){
    //             $("#errorLastName").text("This field is required.");
    //         }
    //         if(email.length === 0 ){
    //             $("#emailError").text("This field is required.");
    //         }
    //         if(confirmEmail.length === 0 ){
    //             $("#confirmEmailError").text("This field is required.");
    //         }
    //         if(password.length === 0 ){
    //             $("#passwordError").text("This field is required.");
    //         }
    //         if(c_password.length === 0 ){
    //             $("#c_passwordError").text("This field is required.");
    //         }
    //     }
    // });



$('#content_detail').click(function(){
    var address1 = $('#address1').val();
    var city = $('#city').val();
    var state = $('#state').val();
    var zipCode = $('#zipCode').val();
    var phone = $('#phone').val();
    var residence = $('#residence').val();

        if(residence.length === 0 ){
            $("#errorResidence").text("This field is required.");
        }
        if(address1.length === 0 ){
            $("#errorAddress1").text("This field is required.");
        }
        if(city.length === 0 ){
            $("#errorCity").text("This field is required.");
        }
        if(state.length === 0 ){
            $("#errorState").text("This field is required.");
        }
        if(zipCode.length === 0 ){
            $("#errorZipCode").text("This field is required.");
        }
        if(phone.length === 0 ){
            $("#errorPhone").text("This field is required.");
        }else{
            var phoneNumber = $('#phone').val();
            var phoneRegex = /^[0-9]{10}$/;
            if (phoneRegex.test(phoneNumber)) {
                  $('#errorPhone').text('');
                } else {
                  $('#errorPhone').text('Please enter a valid 10-digit phone number.');
                }
        }
        if(address1 != '' && city != '' && state != '' && zipCode != '' && residence != '' && phone != ''){
            $("#display3").removeClass("showAccordian");
            $("#collapseTwo").removeClass("show");
            $("#display2").addClass("showAccordian");
            $("#collapseThree").addClass("show");
        }
    
});


$('#license_detail').click(function(){
    var issuingCountry = $('#issuingCountry').val();
    var issuingAuthority = $('#issuingAuthority').val();
    var birthMonth = $('#birthMonth').val();
    var birthDate = $('#birthDate').val();
    var birthYear = $('#birthYear').val();
    var licenseNumber = $('#licenseNumber').val();
    var expMonth = $('#expMonth').val();
    var expDate = $('#expDate').val();
    var expYear = $('#expYear').val();

        if(issuingCountry.length === 0 ){
            $("#errorIssuingCountry").text("This field is required.");
        }
        if(issuingAuthority.length === 0 ){
            $("#errorIssuingAuthority").text("This field is required.");
        }
        if(birthMonth.length === 0 && birthDate.length === 0 && birthYear.length === 0){
            $("#errordob").text("This field is required.");
        }else if(birthMonth.length <= 2){
            $("#errordob").text("Month should not exceed 2 characters.");
        }else if(birthDate.length <= 2){
            $("#errordob").text("Date should not exceed 2 characters.");
        }else{
            $("#errordob").text("Year should not exceed 4 characters.");
        }
        if(expMonth.length === 0 && expDate.length === 0 && expYear.length === 0){
            $("#errorExpiration").text("This field is required.");
        }else if(expMonth.length <= 2){
            $("#errordob").text("Month should not exceed 2 characters.");
        }else if(expDate.length <= 2){
            $("#errordob").text("Date should not exceed 2 characters.");
        }else{
            $("#errordob").text("Year should not exceed 4 characters.");
        }
        if(licenseNumber.length === 0 ){
            $("#errorlicenseNumber").text("This field is required.");
        }
        if(issuingCountry != '' && birthMonth != '' && birthDate != '' && birthYear != '' && licenseNumber != '' && expMonth != '' && expDate != '' && expYear != ''){
        $("#display4").removeClass("showAccordian");
        $("#collapseThree").removeClass("show");
        $("#display3").addClass("showAccordian");
        $("#collapseFour").addClass("show");
    }
    
});


$(".myProfile").submit(function (event) {
    event.preventDefault();
    var isCheckboxChecked = $("#accept_condition").is(":checked");
    if (!isCheckboxChecked) {
        $("#errorTermCondition").text("Please agree to the terms and conditions.");
    }else{
        $(".myProfile").submit();
    }
});


</script>


@endsection