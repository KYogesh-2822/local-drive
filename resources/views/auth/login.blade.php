@extends('layouts.main')

@section('content')

<main class="">



    <section class="txt-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <h1>Sign In</h1>
                </div>
                <div class="col-lg-8">
                    <p>Please sign in to your Enterprise Plus® or Emerald Club® account below.</p>
                </div>
            </div>

        </div>   
    </section>


    <section class="sec-p signin-tabs">
        <div class="container-fluid">

<!-- 
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Enterprise Plus</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Emerald Club</button>
                </div>
            </nav> -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="tab-form">


                        <div class="mt-4 form">
                            <form id="loginForm">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Email or Member Number</label>
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                                <div id="email-error" class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px; display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                                <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                                                <div id="password-error" class="error-message" style="color: #dc3545; font-size: 14px; margin-top: 5px; display: none;"></div>
                                        </div>

                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">Keep me signed in</label>
                                        </div>

                                    </div>



                                    <div class="col-lg-12">
                                        <div class="btn-grid mt-4 text-end">
                                            <button type="submit" class="btn btn-primary" id="loginBtn">Sign In</button>
                                            <!-- <a class="btn-txt d-block mt-3" href="#">Need Help Signing into Your Account?</a> -->
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>
                </div>
                <!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <div class="tab-form">


                        <div class="mt-4 form">
                            <form>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Username or Emerald Club #</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="btn-grid mt-4 text-end">
                                            <a class="btn" href="#">Sign In</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>

                </div> -->
            </div>





        </div>
    </section>



</main>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Clear previous errors
    document.getElementById('email').classList.remove('is-invalid');
    document.getElementById('password').classList.remove('is-invalid');
    document.getElementById('email-error').style.display = 'none';
    document.getElementById('password-error').style.display = 'none';

    // Get form data
    var formData = new FormData(this);

    // Disable button and show loading
    var btn = document.getElementById('loginBtn');
    var originalText = btn.innerHTML;
    btn.innerHTML = 'Signing In...';
    btn.disabled = true;

    // Send AJAX request
    fetch('{{ route("ajax.login") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json().then(data => ({status: response.status, body: data})))
    .then(({status, body}) => {
        btn.innerHTML = originalText;
        btn.disabled = false;

        if (body.success) {
            // Login successful - redirect
            window.location.href = body.redirect;
        } else {
            // Show errors
            if (body.errors) {
                if (body.errors.email) {
                    document.getElementById('email').classList.add('is-invalid');
                    document.getElementById('email-error').innerHTML = body.errors.email[0];
                    document.getElementById('email-error').style.display = 'block';
                }
                if (body.errors.password) {
                    document.getElementById('password').classList.add('is-invalid');
                    document.getElementById('password-error').innerHTML = body.errors.password[0];
                    document.getElementById('password-error').style.display = 'block';
                }
            }
        }
    })
    .catch(error => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        console.error('Error:', error);
    });
});
</script>

@endsection