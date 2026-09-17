@extends('layouts.main')

@section('content')

<main class="">
<div class="breadcrumb">
        <div class="container-fluid">
            <ul class="d-flex breadcrumb-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Terms of Use</a></li>
            </ul>
        </div>
    </div>
    <section class="sec-p about-heading">
        <div class="container">
            <h1>Website Terms of Use</h1>
        </div>
    </section>
    <section class="term_section">
    <div class="container">
        {!! $term->paragraph !!}

        <!-- <h4>INTRODUCTION</h4>
        <p>Enterprise Rent-A-Car Jordan provides this Website<b>(Site)</b>Enterprise Rent-A-Car Jordan provides this Website<b>(&quot;Enterprise&quot; or “We”)</b>. Enterprise Rent-A-Car Jordan is a limited
liability company incorporated in Jordan with company registration number 8633.
Our registered address is at 14 Al Sharif Nasser Bin Jamil Street, Shmeisani,
Amman, Jordan, P.O Box 930174, 11110. Our VAT number is 0174667. You
may contact us by mail, email at <a href="#">info@enterprise.com.jo</a> , or phone at 00962 6
520 5 520. In order to service your needs better If you have a query related to a
reservation or rental then please use contact details provided on our .<a href="#">contact
us</a> page.</p>

<p>This Site is provided for your use, subject to these Terms of Use and all
applicable laws and regulations. Please read these Terms of Use carefully. <b>By
accessing and/or using the Site, you fully and unconditionally accept and
agree to be bound by these Terms of Use. If you do not agree to them,</b> 
please do not visit or use the Site. Enterprise reserves the right to revise these
Terms of Use, so please check back periodically for changes. Your continued
use of the Site following the posting of any changes to these Terms of Use
constitutes your acceptance of those changes. Updates will be evidenced by a
more recent Last Updated date at the top of this page.</p> -->
        </div>
        </div>
    </section>
</main>
@endsection
