@extends('layouts.main')

@section('content')

<main class="content">

    <section class="txt-heading top-bar-heading" style="border-bottom: 0.0625rem solid #c3c3c3;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>Review & Reserve</h1>
                </div>
            </div>

        </div>
    </section>


    <section class="sec-p sec-review-reserve">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="left-grid">

                        <div class="grid grid-rental-detail">
                            <h4>Rental Details</h4>
                            <div class="d-flex coloum">
                                <div class="coloum-txt">
                                    <h6>Dates & Times</h6>
                                    <ul>
                                        <!-- <li>Tue, Feb 27, 2024 @ 12:00 PM</li>
                                        <li>Mon, Mar 25, 2024 @ 12:00 PM</li> -->
                                        <li class="pickup_time_date"></li>
                                        <li class="return_time_date"></li>
                                    </ul>
                                </div>
                                <div class="coloum-btn">
                                    <a href="#" class="btn btn-sm">
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex coloum">
                                <div class="coloum-txt">
                                    <h6>Pick-up & Return Location</h6>
                                    <ul>
                                        <li class="selected-loc-address"></li>
                                    </ul>
                                </div>
                                <div class="coloum-btn">
                                    <a href="#" class="btn btn-sm">
                                        Edit
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex coloum">
                                <div class="coloum-txt">
                                    <h6>Additional Details
                                    </h6>
                                    <ul>
                                        <li>Renter Age: <span class="renter_age">25<span>+</li>
                                        <li>Corporate Account Number: -</li>
                                    </ul>
                                </div>
                                <div class="coloum-btn">
                                    <a href="#" class="btn btn-sm">
                                        Edit
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="grid grid-rental-detail">
                            <div class="d-flex coloum">
                                <div class="coloum-txt">
                                    <h6>Economy</h6>
                                    <ul>
                                        <li>Chevrolet Spark or similar</li>
                                        <li class="icn-img">
                                            <figure>
                                                <img src="images/transmission-gray.svg" alt="icn">
                                            </figure>
                                            <span>Automatic</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="coloum-btn">

                                    <figure class="img">
                                        <img src="images/car.png" alt="images">
                                    </figure>

                                </div>
                            </div>

                            <div class="d-flex coloum">
                                <div class="coloum-txt p-0 w-100">

                                    <ul class="one-line">
                                        <li><span>
                                                <h6>Vehicle</h6>
                                            </span> <em><a href="#" class="btn btn-sm">Edit</a></em></li>
                                        <li><span>Time & Distance 2 Week(s) @ $ 211.61 / Week</span> <em>$ 423.22*</em></li>
                                        <li><span>Extra - Time & Distance 1 Day(s) @ $ 30.23 / Day</span> <em>$ 30.23*</em></li>
                                        <li><span>Unlimited Mileage</span> <em>Included</em></li>
                                    </ul>

                                    <ul class="one-line">
                                        <li><span>
                                                <h6>Extras</h6>
                                            </span> <em><a href="#" class="btn btn-sm">Edit</a></em></li>
                                        <li><span>Sirius Xm® 1 Month(s) @ $ 36.27 / Month</span> <em>$ 36.27*</em></li>
                                    </ul>

                                </div>
                            </div>

                            <div class="d-flex coloum coloum-border">
                                <div class="coloum-txt">
                                    <a class="btn-txt click-btn open-div" href="javascript:void(0)">Taxes & Fees <i class="fa fa-angle-down"></i></a>
                                </div>
                                <div class="coloum-btn">
                                    <span>$ 161.53*</span>
                                </div>
                            </div>


                            <div class="d-flex coloum">
                                <div class="coloum-txt">
                                    <h6>Estimated Total</h6>
                                </div>
                                <div class="coloum-btn">
                                    <span>$ 161.53*</span>
                                </div>
                            </div>

                            <div class="coloum">
                                <p>Estimated total converted to your local currency. Pay later charges will be in <b>CAD (CAD1205.73).</b></p>
                                <p>*Rates, taxes and fees do not reflect rates, taxes and fees applicable to non-included optional coverages or extras added later.</p>
                                <p>**Converted amounts are estimates and are subject to changes as exchange rates vary.</p>
                                <a href="#" class="btn-txt">View Currency Conversion Details</a>
                            </div>



                        </div>

                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="right-grid">

                        <div class="grid coloum-signin">
                            <div class="d-flex w-100 coloum">
                                <div class="coloum-txt">
                                    <h4>Are you a loyalty member?</h4>
                                    <p>Sign in to earn points and speed through the form below.</p>
                                </div>
                                <div class="coloum-btn">
                                    <a href="#" class="btn btn-sm">
                                        Edit
                                    </a>
                                </div>
                            </div>


                        </div>

                        <em>* Required to complete your reservation</em>
                        <div class="grid">
                            <div class="d-flex w-100 coloum">

                                <div class="full-w-b">
                                    <h4>Contact Details</h4>
                                </div>
                            </div>

                            <div class="enterprise_form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <input type="text" name="" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <input type="text" name="" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input type="number" name="" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <div class="form-group">
                                                <label for="">Email Address</label>
                                                <input type="email" name="" id="" class="form-control" placeholder="name@domain.com">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="enterprise_notify mt-3">
                                        <p>Would you like to receive SMS notifications from Enterprise about this rental?</p>

                                        <div class="radio_buttons">
                                            <div class="enterprise_radio_button">
                                                <input type="radio" name="carLogin" id="">
                                                <label for="select">Yes, I would like to receive text messages about this rental to the phone number on this reservation</label>
                                            </div>

                                            <div class="enterprise_radio_button mt-2">
                                                <input type="radio" name="carLogin" id="">
                                                <label for="notSelect">No</label>
                                            </div>
                                        </div>

                                        <p>By selecting "Yes" above, message and data rates may apply. Message frequency varies and depends on the activity of your reservation. You can opt out by responding STOP at any time. For more information, please review our <a href="#">Privacy Policy</a> <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            and <a href="#">SMS Terms</a>
                                            <i class="fa fa-external-link"></i>
                                            . If you choose not to receive text messages, we will give you a courtesy reminder call 1-2 days prior to your reservation.</p>
                                    </div>

                                    <div class="signup_enterprise">
                                        <div class="enterprise_checkbox mt-2">
                                            <input type="checkbox" name="" id="">
                                            <label for="">Sign up for Enterprise Email Specials</label>
                                        </div>

                                        <p>
                                            By selecting this box, you would like to receive email promotions and offers from Enterprise Rent-A-Car (as well as affiliated entities). You also agree that we can use your information and interactions with emails to perform analytics and produce content and ads tailored to your interests. You may see these tailored advertisements and offers on non-Enterprise sites, including on social media and digital advertising platforms. Please understand that there is no charge and that you can unsubscribe at any time by ( i) using the links provided in the emails, (ii) managing your preferences in your Enterprise Plus profile or (iii) contacting us. Please consult our <a href="#">Privacy Policy</a>
                                            and our <a href="#">Cookie Policy</a>
                                            to find out more.</p>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="grid">
                            <div class="d-flex w-100 coloum">

                                <div class="full-w-b">
                                    <h4>Save Time At The Counter</h4>
                                </div>
                            </div>

                            <div class="enterprise_form counter_form">
                                <form action="#">

                                    <div class="enterprise_list">
                                        <div class="clock">
                                            <i class="fas fa-clock"></i>
                                        </div>

                                        <p>Provide more rental details and <span>spend less time at the counter.</span></p>
                                        <ul>
                                            <li>You won't be charged right now</li>
                                            <li>You can cancel at any time</li>
                                            <li>It should only take a couple of minutes</li>
                                        </ul>
                                    </div>
                                    <div class="enterprise_notify mt-3">
                                        <p>Would you like to save time at the counter?</p>

                                        <div class="radio_buttons">
                                            <div class="enterprise_radio_button">
                                                <input type="radio" name="carCounter" id="">
                                                <label for="select">Yes, I'd like to save time</label>
                                            </div>

                                            <div class="enterprise_radio_button mt-2">
                                                <input type="radio" name="carCounter" id="">
                                                <label for="notSelect">No, I'll provide my information at the counter</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="grid">
                            <div class="d-flex w-100 coloum">

                                <div class="full-w-b">
                                    <h4>Flight Details</h4>
                                </div>
                            </div>

                            <div class="enterprise_form airline_form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Airline Name</label>
                                                <select name="flight" id="flight" class="form-control">
                                                    <option value="">Please select an airline</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                    <option value="AIR NOVA">AIR NOVA</option>
                                                    <option value="AIR CANADA">AIR CANADA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Flight Number (Optional)</label>
                                                <input type="text" name="" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flight_buttons">
                                    <button>I don't have a flight</button>
                                    <button>My airline isn't listed</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="grid">
                            <div class="d-flex w-100 coloum">

                                <div class="full-w-b">
                                    <h4>Complete Your Booking</h4>
                                </div>
                            </div>

                            <div class="booking_enterprise">
                            <div class="amount">
                              
                                    <span class="small">$</span>
                                    <span class="big">36</span>
                                    <span class="small">.15</span>
                                    <span class="small">**</span>
                              
                            </div>
                            <p>Estimated Total due at the counter</p>
                            <p>**Estimated total converted to your local currency. You will be charged in <span>CAD (CAD48.74)</span> .</p>
                            <button>View Currency Conversion Details</button>

                            
                            </div>
                        </div>

                        <div class="reserve_button">
                            <button class="btn">Reserve Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<script src="https://code.jquery.com/jquery-3.7.1.slim.js"></script>

@endsection