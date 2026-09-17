@extends('layouts.main')

@section('content')

<main class="">

    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{route('promotion.emailSpecial')}}">Email Car Rental Specials</a></li>
            </ul>
        </div>
    </div>

    <section class="sec-p email-specials">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading mb-5">
                    <div class="row align-items-center">
                        <div class="col-1">
                            <figure><img src="https://www.enterprise.com/etc.clientlibs/ecom/clientlibs/clientlib-ecom/resources/img/ico-email-extras.svg" alt=""></figure>
                        </div>
                        <div class="col-11">
                            <div class="txt">
                                <h2>Sign up for Enterprise Email Specials</h2>
                                <p class="mb-0">Get the latest benefits, updates and great rates delivered directly to your inbox.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form">
                    <form>
                        <cite>* Required to receive email specials</cite>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="firstName" class="form-label">First Name*</label>
                                    <input type="text" class="form-control" id="firstName">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lastName" class="form-label">Last Name*</label>
                                    <input type="text" class="form-control" id="lastName">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="emailAddress" class="form-label">Email Address*</label>
                            <input type="text" class="form-control" id="emailAddress">
                        </div>
                        <div class="form-group">
                            <label for="confirmEmailAddress" class="form-label">Confirm Email Address*</label>
                            <input type="text" class="form-control" id="confirmEmailAddress">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="countrySelect" class="form-label">Country of Residence*</label>
                                    <select class="form-select" aria-label="Default select example" id="countrySelect">
                                        <option selected>United States</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="zipCode" class="form-label">ZIP Code*</label>
                                    <input type="text" class="form-control" id="zipCode">
                                </div>
                            </div>
                        </div>
                        <div class="txt">
                            <p class="mb-2">Where do you rent most frequently?(Optional)</p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="airport">
                                    <label class="form-check-label" for="airport">
                                    Airport
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="nearHome">
                                    <label class="form-check-label" for="nearHome">
                                        Near home
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="selectBoth" checked>
                                    <label class="form-check-label" for="selectBoth">
                                        Both
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="txt">
                            <p>By checking Sign up for Enterprise Email Specials, you would like to receive email promotions and offers from Enterprise (as well as affiliated entities). You also agree that we can use your information and interactions with emails to perform analytics and produce content and ads tailored to your interests. You may see these tailored advertisements and offers on non-Enterprise sites, including on social media and digital advertising platforms. There is no charge and you can unsubscribe at any time by using the links provided in the emails, (ii) managing your preferences in your Enterprise Plus (Emerald Club) profile or (iii) contacting us. Please consult our <a href="#" class="btn-txt">Privacy Policy <i class="fa fa-external-link"></i></a> and our <a href="#" class="btn-txt">Cookie Policy <i class="fa fa-external-link"></i></a> to find out more.</p>
                        </div>

                        <div class="text-end">
                            <a href="#" class="btn">Submit</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </section>

</main>

@endsection