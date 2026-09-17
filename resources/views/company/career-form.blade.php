@extends('layouts.main')

@section('content')

<main class="">
  <section class="form_section" style="background-image:url('assets/images/form_bg.webp')">
    <div class="container">
      <h1 class="visually-hidden">Apply for a Career at Enterprise Rent-A-Car Jordan</h1>
      <div class="form">
        <div class="clear">
          <h3>Personal information</h3> <button type="button" class="personal_clear"><i class="fas fa-trash"></i>clear</button>
        </div>
        @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
        </ul>
      </div>
    @endif
        @if(session()->has('message'))
      <div class="alert alert-success">
        {{ session()->get('message') }}
      </div>
    @endif
        <form name="contact-form" id="contactForm" method="post" action="{{route('company.careerFormSave')}}"
          autocomplete="off" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name"><sup>*</sup> First name</label>
                <input type="text" class="form-control" name="fname" required="" autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="name"><sup>*</sup> Last name</label>
                <input type="text" class="form-control" name="lname" required="" autocomplete="off">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="email"><sup>*</sup> Email</label>
                <input type="text" class="form-control" name="email" required="" autocomplete="off">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="headline">Headline <span class="optional">(optional)</span></label>
                <input type="text" class="form-control" name="headline" autocomplete="off">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" class="form-control" id="phone" name="phone" required="" autocomplete="off">
                <span class="hire">The hiring team may use this number to contact you about this job.</span>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="address">Address <span class="optional">(optional)</span></label>
                <textarea class="form-control" id="address" name="address" autocomplete="off"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <label for="photo">Photo <span class="optional">(optional)</span> <span class="qus">?</span></label>
              <div class="form-group upload_file">
                <i class="fas fa-user"></i>
                <div class="upload photoUpload">
                  <button class="custom-button">Upload a file</button><span>or drag and drop here</span>
                </div>
                <input type="file" id="photo" name="photo" id="photo">
              </div>
            </div>
            <div class="clear">
              <h3>Profile</h3> <button type="button" class="profile_clear"><i class="fas fa-trash"></i>clear</button>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="education">Education <span class="optional">(optional)</span></label>
              </div>
              <div class="form-group education">
                <input type="text" class="form-control profile-education" name="education[]" autocomplete="off">
                <button type="button" id="add-field">+ add</button>
                </div>
                <div  id="input-container">
                   
                </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="experience">Experience <span class="optional">(optional)</span></label>
              </div>
              <div class="form-group education">
                <input type="text" class="form-control profile-exp" name="exp[]" autocomplete="off">
                <button type="button" id="add-exp">+ add</button>
              </div>
              <div  id="input-container1">
                   
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="summary">Summary <span class="optional">(optional)</span></label>
                <textarea id="summary" name="summary" rows="4" cols="50"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <label for="resume"><sup>*</sup> Resume <span class="qus">?</span></label>
              <div class="form-group upload_file resume">
                <i class="fas fa-upload"></i>
                <div class="upload resumeUpload">
                  <button class="custom-button">Upload a file</button><span>or drag and drop here</span>
                </div>
                <input type="file" id="resume" name="resume" required>
              </div>
            </div>
            <div class="clear">
              <h3>Details</h3> <button type="button" class="cover_clear"><i class="fas fa-trash"></i>clear</button>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="letter">Cover Letter <span class="optional">(optional)</span> </label>
                <textarea id="cover_letter" name="cover_letter" rows="4" cols="50"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="common_lead_button">
                <button class="" type="submit">Submit application </button>
              </div>
            </div>
          </div>
        </form>
        </div>
        <div class="mt-5">
          <p>Enterprise Rent-A-Car Jordan does not discriminate on the basis of race, sex, color, religion, age, national origin, marital status, disability, veteran status, genetic information, sexual orientation, gender identity or any other reason prohibited by law in provision of employment opportunities and benefits.</p>
        </div>
        </div>
  </section>
</main>
<link rel="stylesheet" href="{{asset('build/css/intlTelInput.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
<script src="{{asset('build/js/intlTelInput-jquery.min.js')}}"></script>
<script>
  // Build the large country selector only when the applicant uses the field.
  $("#phone").one('focus', function () {
    if ($.fn.intlTelInput) {
      $(this).intlTelInput({
        showSelectedDialCode: true
      });
    }
  });

  $('.personal_clear').click(function () {
    $('input[name="fname"]').val('');
    $('input[name="lname"]').val('');
    $('input[name="email"]').val('');
    $('input[name="phone"]').val('');
    $('#address').val('');
    $('input[name="photo"]').val('');
    $('input[name="headline"]').val('');
  });

  $('.profile_clear').click(function () {
    $('#summary').val('');
    $('.profile-education').val('');
    $('.profile-exp').val('');
    $('input[name="resume"]').val('');
  });

  $('.cover_clear').click(function () {
    $('#cover_letter').val('');
  });

  $('#photo').change(function () {
    $('.photoUpload').html('');
    var file = $('#photo')[0].files[0].name;
    $('.photoUpload').append(file);
  });

  $('#resume').change(function () {
    $('.resumeUpload').html('');
    var file1 = $('#resume')[0].files[0].name;
    $('.resumeUpload').append(file1);
  });

  $(document).ready(function () {
    $('#add-field').click(function () {
      $('#input-container').append(`<div class="form-group education"> <input type="text" class="form-control profile-education" name="education[]" autocomplete="off">
        <button class="remove-field">+ Remove</button> </div>`);
    });
    $('#add-exp').click(function () {
      $('#input-container1').append(`<div class="form-group education"> <input type="text" class="form-control profile-exp" name="exp[]" autocomplete="off">
        <button class="remove-exp">+ Remove</button> </div>`);
    });

    $('#input-container').on('click', '.remove-field', function () {
      $(this).parent().remove();
    });
    $('#input-container1').on('click', '.remove-exp', function () {
      $(this).parent().remove();
    });
  });
</script>
@endsection
