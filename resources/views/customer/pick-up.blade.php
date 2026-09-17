@extends('layouts.main')

@section('content')
<style>
    .faq-p ul li {
    list-style-type:disc ; 
    margin-left: 15px;
}
</style>
<main class="content">


    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Will Enterprise Pick Me Up?</a></li>
            </ul>
        </div>
    </div>

    <!-- <section class="sec-p pb-0 band">

        <div class="container">
            <div role="group" aria-label="Was this helpful?" class="QSI__EmbeddedFeedbackContainer" style="margin-top: 10px; white-space: normal;">
                <fieldset><label tabindex="-1" class="QSI__EmbeddedFeedbackContainer_QuestionText" style="line-height: 1em; margin: 0px 0.7em 0px 0px; width: auto; font-size: inherit; font-weight: normal; font-style: normal; display: inline; color: rgb(50, 54, 58);">Was this helpful?</label>
                    <div class="QSI__EmbeddedFeedbackContainer_Thumbs" style="display: inline-block; margin-right: 5px;">
                    <button class="QSI__EmbeddedFeedbackContainer_SVGButton" onclick="likeDislike('like',{{$data->id}})" title="Thumbs Up" style="font: inherit; background: transparent; border: none; padding: 0px; vertical-align: middle; margin: 0px 0.6em   0px 0px; cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="1.7em" height="1.7em" fill="" viewBox="0 0 21 20" alt="Thumbs Up">
                                <title>Thumbs Up</title>
                                <path fill="rgba(255, 255, 255, 1)" fill-rule="evenodd" d="M5.5 17.755c.542.407 1.199.671 1.918.735l6.311.561a3.75 3.75 0 003.803-2.315l2.252-5.505c.875-2.138-.698-4.48-3.008-4.48H14.5l-.085-.001h-.797a.183.183 0 01-.1-.026c-.014-.009-.017-.015-.018-.021A5.857 5.857 0 0113.25 5V3A2.75 2.75 0 0010.5.25H9a.75.75 0 00-.75.75v3.882a3.187 3.187 0 01-2.457 3.102c-.1.024-.199.054-.293.09V8a.75.75 0 00-.75-.75h-4A.75.75 0 000 8v10c0 .414.336.75.75.75h4A.75.75 0 005.5 18v-.245z" clip-rule="evenodd"></path>
                                <path fill="rgba(18,127,74,1)" fill-rule="evenodd" d="M5.5 17.755c.542.407 1.199.671 1.918.735l6.311.561a3.75 3.75 0 003.803-2.315l2.252-5.505c.875-2.138-.698-4.48-3.008-4.48H14.5l-.085-.001h-.797a.183.183 0 01-.1-.026c-.014-.009-.017-.015-.018-.021A5.857 5.857 0 0113.25 5V3A2.75 2.75 0 0010.5.25H9a.75.75 0 00-.75.75v3.882a3.187 3.187 0 01-2.457 3.102c-.1.024-.199.054-.293.09V8a.75.75 0 00-.75-.75h-4A.75.75 0 000 8v10c0 .414.336.75.75.75h4A.75.75 0 005.5 18v-.245zM9.75 1.75v3.132a4.687 4.687 0 01-3.614 4.562.825.825 0 00-.636.803v4.508a2.25 2.25 0 002.05 2.241l2.991.266a2.25 2.25 0 01-.86-2.612l2.141-6.065c.12-.341.303-.647.533-.907a1.522 1.522 0 01-.29-.535A7.355 7.355 0 0111.75 5V3c0-.69-.56-1.25-1.25-1.25h-.75zM4 8.75H1.5v8.5H4v-8.5zm9.862 8.807l-.275-.024a.749.749 0 00-.17-.157l-2.03-1.353a.75.75 0 01-.291-.873l2.14-6.066a1.25 1.25 0 011.16-.834h2.38a1.75 1.75 0 011.62 2.413l-2.252 5.505a2.25 2.25 0 01-2.282 1.389z" clip-rule="evenodd"></path>
                            </svg>
                        </button>


                        <button class="QSI__EmbeddedFeedbackContainer_SVGButton" onclick="likeDislike('dislike',{{$data->id}})" title="Thumbs Down" style="font: inherit; background: transparent; border: none; padding: 0px; vertical-align: middle; margin: 0px 0.6em 0px 0px; cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" fill="" width="1.7em" height="1.7em" viewBox="0 0 21 20" alt="Thumbs Down">
                                <title>Thumbs Down</title>
                                <path fill="rgba(255, 255, 255, 1)" fill-rule="evenodd" d="M15.5 2.245a3.736 3.736 0 00-1.918-.735L7.271.949a3.75 3.75 0 00-3.803 2.315L1.216 8.77c-.875 2.138.698 4.48 3.008 4.48H6.5l.085.001h.797c.049 0 .083.014.1.025.014.01.016.016.018.022.118.385.25.977.25 1.703v2a2.75 2.75 0 002.75 2.75H12a.75.75 0 00.75-.75v-3.882a3.187 3.187 0 012.457-3.102c.1-.024.199-.054.293-.09V12c0 .414.336.75.75.75h4A.75.75 0 0021 12V2a.75.75 0 00-.75-.75h-4a.75.75 0 00-.75.75v.245z" clip-rule="evenodd"></path>
                                <path fill="rgba(18,127,74,1)" fill-rule="evenodd" d="M15.207 12.015c.1-.023.198-.053.293-.089V12c0 .414.336.75.75.75h4A.75.75 0 0021 12V2a.75.75 0 00-.75-.75h-4a.75.75 0 00-.75.75v.126a3.737 3.737 0 00-1.755-.717L7.433.567a3.75 3.75 0 00-3.988 2.35L1.136 8.816c-.834 2.132.738 4.435 3.027 4.435h3.38c.092.284.207.823.207 1.75v2a2.75 2.75 0 002.75 2.75H12a.75.75 0 00.75-.75v-3.882a3.187 3.187 0 012.457-3.103zM11.25 18.25v-3.132a4.687 4.687 0 013.614-4.563.825.825 0 00.636-.803V5.126a2.25 2.25 0 00-1.953-2.23l-6.314-.842a2.25 2.25 0 00-2.392 1.41L2.533 9.362a1.75 1.75 0 001.63 2.388h3.423c.053 0 .108.002.164.008v-.064a1.25 1.25 0 00-1.044-1.233l-1.33-.222a.75.75 0 01.247-1.48l1.33.222a2.75 2.75 0 012.297 2.713V17c0 .69.56 1.25 1.25 1.25h.75zm5.75-7v-8.5h2.5v8.5H17z" clip-rule="evenodd"></path>
                            </svg></button>
                    </div>
                </fieldset>
            </div>
        </div>
    </section> -->


    <section class="px-0 txt-heading">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{$data->question ?? ''}}</h1>
                    <div class="txt mt-3 faq-p" >
                        {!! str_ireplace(['<h1', '</h1>'], ['<h2', '</h2>'], $data->answer ?? '') !!}
                    </div>
                    @if($data->id == 23)
                    <div><img src="{{asset('images/faq.png')}}" alt=""></div>
                    @endif
                    @if($data->id == 26)
                    <section class="policy_section" id="policySection">
                        <div class="container">
                            <div class="accordion" id="accordionExample" style="background:none">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Am I able to get help with installation of the car seat?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <span>Enterprise employees cannot install the child seats for customers but can give out directions that explain how to properly install them.</span>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            What happens if it gets damaged during my rental reservation?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <span>As with any other optional accessory or product, you will be responsible for any damages incurred during a rental reservation.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Are your car seats clean/sanitized?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <span>All accessories are cleaned in accordance with our Complete Clean Pledge, including child seats.</span>
                                        </div>
                                    </div>
                                </div>
                             
                             
                            </div>
                    </section>
                    @endif
                    <div class="txt mt-3 ">
                        <a style="text-decoration: none;" class="mt-4 btn-txt" href="{{route('customer.faq')}}">
                            << Go Back to Full List of FAQs</a>
                    </div>

                </div>
            </div>

        </div>
    </section>




    <section class="p-0 sec-p address">
        <div class="container-fluid">
            <div class="hero-form m-auto border-0 bg-transparent">
                <div class="heading">
                    <h3 class="m-0"><span class="ps-0">Check Prices & Availability</span></h3> <span>or <a href="{{route('reservation.vMc')}}">View / Modify / Cancel Reservation</a></span>
                </div>
                <div  id="pbk-widget"></div> 
            </div>
        </div>
    </section>




</main>
<!-- <script>
    function likeDislike(status,id){
      $.ajax({
        type:"GET",
        cache:false,
        url:"/like-dislike",
        data:{id:id,status:status},    // multiple data sent using ajax
        success: function (data) {
           console.log(data);
        }
      });
    }
</script> -->
@endsection
