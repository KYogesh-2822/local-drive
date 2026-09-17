@extends('layouts.main')

@section('content')

<main class="">

    <section class="career_section">
        <div class="container">
            <h1 class="visually-hidden">Careers at Enterprise Rent-A-Car Jordan</h1>
            {!! $data->banner_content !!}
            <!-- <ol>
                <p><b>Why Work for Enterprise Rent-A-Car Jordan?</b></p>
                <p>At Enterprise Rent-A-Car Jordan, we're not just in the business of renting cars; we're in
                    the business of shaping careers. Here's why joining our team is an opportunity you
                    won't want to miss:</p>
                <li><b>Career Growth:</b> We believe in promoting from within. When you join Enterprise, you're not
                    just
                    getting a job; you're embarking on a career path with endless opportunities for growth and
                    advancement.</li>
                <li><b>Training and Development:</b> Our comprehensive training programs are designed to equip you
                    with the skills and knowledge you need to succeed. Whether you're just starting out or looking
                    to take your career to the next level, we're committed to helping you reach your full potential.
                </li>
                <li><b>Culture of Excellence:</b> At Enterprise, we pride ourselves on our culture of excellence.
                    We're
                    passionate about delivering exceptional service to our customers, and we're equally dedicated
                    to creating a positive and inclusive work environment for our employees.</li>
                <li><b>Work-Life Balance:</b> We understand the importance of work-life balance, which is why we offer
                    flexible scheduling options and competitive benefits packages to support our employees both
                    on and off the job.</li>
                <li><b>Community Impact:</b> We believe in giving back to the communities we serve. Through our
                    philanthropic initiatives and volunteer programs, we're making a positive impact in Jordan and
                    beyond.</li>
                <p>Join us at Enterprise Rent-A-Car Jordan and discover why we're not just a company;
                    we're a family committed to helping you succeed. <a href="{{route('company.careerForm')}}">Apply today</a> and take the first step
                    towards a rewarding career with us.</p>
            </ol> -->
        </div>
    </section>

</main>
@endsection
