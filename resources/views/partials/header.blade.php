<header class="header">
        <div class="container-fluid">
        <div id="translate__el"></div>
            <div class="top-bar">
                <div class="logo">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{asset('images/logo.png')}}" alt="logo">
                    </a>
                </div>
                <div class="top-links">
                    <ul class="d-flex">
                        <?php  $top_nav =  DB::table('nav_top')->get(); ?>
                        @foreach($top_nav as $top)
                        <li><a href="{{$top->link}}" target="_blank"><i class="{{ $top->heading == 'Find a Location' ? 'fa fa-map-marker' : ''}}"></i> {{$top->heading}}</a></li>
                        @endforeach
                        <!-- <li><a href="https://careers.enterprise.com/?mcid=internal:42072848&_gl=1*1jml1kl*_ga*MTIzNTg1NjIyLjE3MDA3Mzc0NzM.*_ga_BEMPZFZ04Z*MTcwMzE1NTA1My4xNi4xLjE3MDMxNjE2NzIuNjAuMC4w">Careers <i class="fa fa-external-link"></i></a></li>
                        <li><a href="{{route('customer.faq')}}">Help</a></li>
                        <li><a href="{{route('location.inter')}}"><i class="fa fa-map-marker"></i> Find a Location</a></li> -->
                        <!-- <li><a >CAD ($)</a></li> -->
                        <!-- <li><a href="#"><i class="fa fa-globe"></i> USA (English)</a></li> -->
                        @php 
                            $lang = App::getLocale();
                        @endphp
                        <li>
                            <div class="dropdown dropdown-hover">
                                <a href="#" class="dropdown-toggle" id="lang-switch-ls" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-globe"></i> USA (English)</a>
                                <ul class="dropdown-menu" aria-labelledby="lang-switch-ls">
                                    <li><a class="dropdown-item" >SELECT A LANGUAGE</a></li>
                                    <li><a class="dropdown-item lang-switch"  data-val ="en">
                                        <!-- English -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="language" id="english">
                                            <label class="form-check-label" for="english">
                                            English
                                            </label>
                                        </div>
                                    </a></li>
                                    <li><a class="dropdown-item lang-switch" data-val ="ar">
                                        <!-- Arabic -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="language" id="arabic">
                                            <label class="form-check-label" for="arabic">
                                            Arabic
                                            </label>
                                        </div>
                                    </a></li>
                                </ul>
                            </div>
                        </li> 
                            
                                   
                        <!-- <li>
                        @guest
                            @if (Route::has('login'))
                                <a class="btn" href="{{ route('login') }}">Sign in / Join</a>
                            @endif
                            @else 
                                <a class="btn" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endguest
                        </li> -->
                    </ul> 
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <a class="navbar-brand d-none" href="#">
                    <img src="{{asset('images/logo.png')}}" alt="logo">
                </a>
                <button class="navbar-toggler" id="open_menu" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <i class="fas fa-times" id="shut_menu"></i>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                         <?php $heading = DB::table('nav_headings')->take(5)->get(); ?>
                         @foreach($heading as $head)
                         <li class="nav-item dropdown-hover dropdown">
                            <a class="nav-link dropdown-toggle active" aria-current="page" href="{{route('reservation')}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{$head->heading}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php $sub_heading = DB::table('nav_sub_headings')->where('nav_id',$head->id)->where('status',1)->get(); ?>
                                @foreach($sub_heading as $sub)
                                    @if($sub->id == 13)
                                    <!-- <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#car-sales-model">{{$sub->sub_heading}}</a></li> -->
                                    <li><a class="dropdown-item" href="{{$sub->link}}">{{$sub->sub_heading}}</a></li>
                                    @else
                                    <li><a class="dropdown-item" href="{{$sub->link}}">{{$sub->sub_heading}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                     
 

                        <li class="nav-item dropdown dropdown-hover has-megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Learn</a>
                            <div class="dropdown-menu megamenu" role="menu">
                                <div class="row g-3">
                                    <?php $heading1 = DB::table('nav_headings')->skip(5)->take(3)->get(); 
                                    ?>
                                    @foreach($heading1 as $head1)
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">{{$head1->heading}}</h6>
                                            <ul class="list-unstyled">
                                              <?php $sub_heading1 = DB::table('nav_sub_headings')->where('nav_id',$head1->id)->where('status',1)->get(); ?>
                                                @foreach($sub_heading1 as $sub1)
                                                  <li><a href="{{$sub1->link}}">{{$sub1->sub_heading}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div> 
                                    </div>
                                    @endforeach
                                </div><!-- end row -->
                            </div> <!-- dropdown-mega-menu.// -->
                        </li>
                        @if(config('content.managed_pages_live'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('content.blog.index') }}">Travel Guides</a>
                        </li>
                        @endif
                    </ul>
                </div>

            </nav>
        </div>
    </header>