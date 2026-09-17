@extends('layouts.main')

@section('content')
<main class="">

 <!-- HERO SECTION START -->
  <section class="booking-section">
    <div class="container">
      <div class="booking-content">
        <h1>Reserve a Vehicle</h1>
        <p>Find the perfect car for your journey across Jordan</p>
        <div class="booking-box">
          <form>
            <div class="row align-items-end g-3">
              <div class="col-lg-3 col-md-6">
                <label>Pick-Up Location</label>
                <select class="form-select">
                  <option>Amman Airport</option>
                  <option>Amman City</option>
                  <option>Aqaba</option>
                </select>
              </div>
              <div class="col-lg-3 col-md-6">
                <label>Pick-Up Date</label>
                <input type="date" class="form-control">
              </div>
              <div class="col-lg-3 col-md-6">
                <label>Return Date</label>
                <input type="date" class="form-control">
              </div>
              <div class="col-lg-3 col-md-6">
                <button type="submit" class="btn-search w-100"> Search </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
   <!-- HERO SECTION END -->

  <!-- FLEET SECTION START -->
  <section class="fleet-section">
    <div class="container">
      <div class="section-title text-center">
        <h2 class="custom_heading">Meet the Fleet</h2>
        <p class="custom_para">From SUVs to compact cars, we've got your perfect ride</p>
      </div>
      <div class="row g-4 justify-content-center">
        <!-- Card 1 -->
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="fleet-card">
            <div class="fleet-img"> <img src="../images/new/vehicles.png" alt="vehicle"></div>
            <h4>Mini</h4>
            <p>Ideal for solo travelers with excellent fuel efficiency</p>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="fleet-card">
            <div class="fleet-img"> <img src="../images/new/vehicles.png" alt="vehicle"> </div>
            <h4>Economy</h4>
            <p>Affordable and reliable for city exploration</p>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="fleet-card">
            <div class="fleet-img"> <img src="../images/new/vehicles.png" alt="vehicle"> </div>
            <h4>Compact</h4>
            <p>Perfect balance of comfort and efficiency</p>
          </div>
        </div>
        <!-- Card 4 -->
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="fleet-card">
            <div class="fleet-img"> <img src="../images/new/vehicles.png" alt="vehicle"> </div>
            <h4>Intermediate</h4>
            <p>Extra space for small families and groups</p>
          </div>
        </div>
        <!-- Card 5 -->
        <div class="col-lg-2 col-md-4 col-sm-6">
          <div class="fleet-card">
            <div class="fleet-img"> <img src="../images/new/vehicles.png" alt="vehicle"></div>
            <h4>Standard</h4>
            <p>Premium comfort for long-distance journeys</p>
          </div>
        </div>
      </div>
      <div class="text-center mt-5">
        <a href="#" class="fleet-btn">View All Vehicles</a>
      </div>
    </div>
  </section>
   <!-- FLEET SECTION END -->

<!-- STANDARD SECTION START -->
<section class="standard-section">
  <div class="container">
    <div class="section-title text-center">
      <h2 class="custom_heading">Our Standard of Care</h2>
      <p class="custom_para">Your safety and comfort are our top priority</p>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="care-card">
          <div class="care-header">
            <div class="care-icon">✓</div>
            <h3>Safety First</h3>
          </div>
          <div class="care-body">
            <h3>We Maintain Excellence</h3>
            <p> Every vehicle is carefully inspected and maintained before every rental. We ensure reliability, comfort, and your peace of mind throughout your journey. </p>
            <button class="btn-primary">Learn More</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- STANDARD SECTION END -->



   
  <!-- Car Rental START -->
<section class="fleet-section">
  <div class="container section-container">
    <div class="section-title text-center">
      <h2 class="custom_heading">Car Rental & Much More</h2>
      <p class="custom_para">Beyond traditional car rental – your complete transportation solution</p>
    </div>
    <div class="row g-4 justify-content-center">
      <!-- Card 1 -->
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="service-card">
          <div class="service-image">
            <img src="../images/new/vehicles.png" alt="vehicle">
          </div>
          <div class="service-body">
            <div class="service-label">Service</div>
            <h3>The Limousine Service</h3>
            <p>Our car with driver service offers personalized transportation tailored to your requirements, ensuring convenience and efficiency for your travels.</p>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="service-card">
          <div class="service-image">
            <img src="../images/new/vehicles.png" alt="vehicle">
          </div>
          <div class="service-body">
            <div class="service-label">Meet</div>
            <h3>Our People</h3>
            <p>Every day at Enterprise is different. We care deeply about what our customers think and how they feel. Your satisfaction drives everything we do.</p>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="service-card">
          <div class="service-image">
            <img src="../images/new/vehicles.png" alt="vehicle">
          </div>
          <div class="service-body">
            <div class="service-label">Inspiration</div>
            <h3>Explore Jordan</h3>
            <p>Embark on a journey through Jordan's stunning landscapes. Let Enterprise help you create unforgettable memories of this extraordinary destination.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Car Rental END -->





     <!-- Freedom section start -->
  <section class="standard-section">
    <div class="container section-container">
      <div class="section-title text-center">
        <h2 class="custom_heading">Explore Jordan with Freedom</h2>
        <p class="custom_para">Design your itinerary and explore at your own pace</p>
      </div>
      <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="destination-card">
        <h4>Petra</h4>
        <p>The ancient rose-red city carved into cliffs, one of the New Seven Wonders of the World and a UNESCO World Heritage Site</p>
      </div>
        </div>
                <!-- Card 2 -->
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="destination-card">
        <h4>The Dead Sea</h4>
        <p>Known for its unique floating experience and mineral-rich waters. The lowest point on Earth offers therapeutic healing benefits</p>
      </div>
 </div>
 </div>
 <div class="row justify-content-center mt-4">
        <!-- Card 3 -->
        <div class="col-lg-6 col-md-6 col-sm-12">
<div class="destination-card">
        <h4>Wadi Rum</h4>
        <p>A stunning desert landscape famous for its red sand and dramatic cliffs. Perfect for adventure seekers and nature lovers</p>
      </div>
        </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="destination-card">
        <h4>Jerash</h4>
        <p>One of the best-preserved Roman cities outside Italy with incredible history. A must-visit for archaeology enthusiasts</p>
      </div>
        </div>
      </div>
     
    </div>
  </section>
   <!-- Freedom section end -->




<!-- Maintenance section start -->
   <section class="fleet-section">
    <div class="container">
      <div class="section-title text-center">
        <h2 class="custom_heading">Safety & Maintenance Standards</h2>
        <p class="custom_para">Rigorous inspections ensure your safety on every journey</p>
      </div>
      <div class="row justify-content-center">
      <div class="col-lg-6 col-md-6 col-sm-12">
<ul class="safety-list">
      <li>Regular servicing and mechanical inspections before every rental</li>
      <li>Thorough cleaning and sanitisation for every vehicle</li>
      <li>Brake, tyre, and engine performance checks for optimal safety</li>
      <li>Continuous fleet monitoring to ensure road readiness and reliability</li>
      <li>Replacement of vehicles that do not meet our safety standards</li>
    </ul>
      </div>
    </div>
  </div>
</section>
<!-- Maintenance section end -->


<!-- Booking section start -->
   <section class="standard-section">
    <div class="container section-container ">
      <div class="section-title text-center">
        <h2 class="custom_heading">Our Easy Booking Process</h2>
        <p class="custom_para">Simple steps to secure your vehicle in minutes</p>
      </div>
      <div class="row justify-content-center">
      <div class="col-lg-3 col-md-6 col-sm-12">
<div class="process-item text-center">
        <div class="step-badge">1</div>
        <h4>Select Vehicle</h4>
        <p>Browse our fleet and choose a vehicle that matches your needs and budget</p>
      </div>
      </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
<div class="process-item text-center">
        <div class="step-badge">2</div>
        <h4>Choose Dates</h4>
        <p>Select your pick-up location and rental dates for your trip</p>
      </div>
      </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
<div class="process-item text-center">
        <div class="step-badge">3</div>
        <h4>Confirm Booking</h4>
        <p>Complete your reservation through our secure booking system</p>
      </div>
      </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
<div class="process-item text-center">
        <div class="step-badge">4</div>
        <h4>Collect & Drive</h4>
        <p>Pick up your vehicle and begin your journey with confidence</p>
      </div>
      </div>
    </div>
  </div>
</section>
<!-- Booking section end -->


<!-- Maintenance section start -->
   <section class="fleet-section accordion">
          <div class="container section-container">
            <div class="section-title text-center">
              <h2 class="custom_heading">Frequently Asked Questions</h2>
              <p class="custom_para">Quick answers to your common questions
              </p>
            </div>
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
          
            </div>
          </div>
        </div>
</section>
<!-- Maintenance section end -->

</main>
<script type="text/javascript">
var pbk = {
  "settings" : {
    "kicker" : "#pbk-widget",
    "contentContainer" : "#pbk-widget2mk",
    "brand" : "ET"
  }

};

(function(){
    var d=document,
    l=d.createElement('link'),
    s=d.createElement('script'),
    u='https://widget-cdn.partnerbookingkit.com/bundles/82c62ca4123d9/widget.';
    l.href=u+'css';
    l.rel='stylesheet';
    d.head.appendChild(l);
    s.src=u+'js';
    s.async=true;d.head.appendChild(s)
    })();

 </script> 

@endsection