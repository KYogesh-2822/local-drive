@include("layouts.admin.header")
<header id="header" class="site-header background_lgray">
    <div class="main-header">
        <div class="nav-group">
            <div class="left-menu">
                <a href="javascript:void(0);" class="toggle-btn d-block d-md-none">
                    <i class="la la-bars"></i>
                </a>
                <div class="profile-action">
                    <a>
                   
                        <div class="user-img" style="background-image: url({{url('/admin/images/profile-icon.png')}});"></div>
                        <p>Admin</p><i class="fas fa-caret-down"></i>
                     
                    </a>
                    <div class="drop-area">
                        <ul>
                            <li>
                                <a href="{{url('profile')}}">
                                    <i class="la la-user-o" aria-hidden="true"></i> <span>Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    <i class="la la-sign-out" aria-hidden="true"></i>
                                    <span>Log Out</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="layer"></div>

<aside class="main-sidebar background_lgray">
    <div class="logo-sidebar">
        <a href="" class="logo-img">
            <img src="{{asset('/images/logo.png')}}" alt="">
        </a>
    </div>
    <div class="dashboard-listing">
        <ul class="nav flex-column" id="nav_accordion">
            <!--<li class="nav-item has-submenu">-->
            <!--    <a class="nav-link" href="{{route('admin.dashboard')}}">-->
            <!--      <i class="fa-solid fa-table-columns"></i>   <span class="big pl-4">Dashboard</span>-->
            <!--    </a>-->
            <!--</li>-->
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.jodan.vehicles')}}">
                  <i class="fa-solid fa-table-columns"></i>   <span class="big pl-4">Jordan Vechiles</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.user.list')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Enquire Form List</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.nav')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Navbar</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.homePage')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Home page</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{ route('admin.content.pages.index') }}">
                  <i class="fa-solid fa-file-lines"></i> <span class="big pl-4">Content Manager</span>
                </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{ route('admin.content.pages.index') }}">Managed Pages</a></li>
                    <li><a class="nav-link" href="{{ route('admin.content.faqs.index') }}">Page & Blog FAQs</a></li>
                    <li><a class="nav-link" href="{{ route('admin.content.blogs.index') }}">Blog Posts</a></li>
                    <li><a class="nav-link" href="{{ route('admin.content.categories.index') }}">Blog Categories</a></li>
                </ul>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.reservation')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Reservation</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.vehicle')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Vechiles</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.location')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Location</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="#">
                <i class="fa-solid fa-list"></i>  
                    <span class="big">Business</span><i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{route('admin.business')}}"> Solutions for Business</a></li>
                    <li><a class="nav-link" href="{{route('admin.retailForm')}}"> Business Rental Form</a></li>
                    <!-- <li><a class="nav-link" href="{{route('admin.travel')}}">Travel Advisor/Administrator</a></li>
                    <li><a class="nav-link" href="{{route('admin.military')}}">Government & Military Rentals </a></li> -->
                </ul>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.faq')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">FAQ</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.service.serviceFaq')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Customer Service</span>
                </a>
            </li>
            <!-- <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.website')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Websites by Country</span>
                </a>
            </li> -->
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.contact')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Contact Us</span>
                </a>
            </li>
            <!-- <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.promotion')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Promotions</span>
                </a>
            </li> -->
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.inspiration')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Inspiration</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="#">
                <i class="fa-solid fa-list"></i>  
                    <span class="big">The Company</span><i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{route('admin.about')}}"> About Us</a></li>
                    <!-- <li><a class="nav-link" href="{{route('admin.mobility')}}">Total Mobility Solutions</a></li> -->
                    <li><a class="nav-link" href="{{route('admin.meet')}}"> Meet Our people</a></li>
                    <li><a class="nav-link" href="{{route('admin.career')}}">Careers</a></li>
                </ul>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.policy.index')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Rental Policies</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.policy.services')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Services & Policies</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.learn')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Learn About Enterprise Plus®</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.LongTermRental')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Long Term Car Rental</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.oneWayRental')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">One Way Car Rental</span>
                </a>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.StandardOfCare')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Standard of Care</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.termsofuse')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Terms of Use</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.privacypolicy')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Privacy Policy</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.cookiepolicy')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Cookie Policy</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="{{route('admin.termscondition')}}">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Terms And Conditions</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link" href="">
                  <i class="fa-solid fa-list"></i>   <span class="big pl-4">Explore Jordan</span>
                </a>
            </li>

        </ul>
    
    </div>
</aside>
<main class="content">
@yield('content')
</main>
@include('layouts.admin.footer')