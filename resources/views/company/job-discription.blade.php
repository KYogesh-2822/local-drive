@extends('layouts.main')

@section('content')

<main class="career">

        <div class="container my-5">
            <section class="job-description" data-selector-name="jobdetails" data-org-id="430" data-job-id="61243199392" data-save-jobs="true">
    
                <h1>{{$data->profile ?? ''}}</h1>    
                
                <div class="jd-job-info-wrap">
                    <span class="job-id job-info"><b>Job ID</b> {{$data->id ?? ''}}</span> 
                    <span class="job-id job-info"> {{$data->location ?? ''}}</span>
                </div>
        
                <div class="jd-logo-wrap">
                    <img class="jd-logo jd-logo--enterprise" src="{{asset('images/logo.png')}}" alt="Enterprise" width="200">  
                </div>
        
                <div class="jd-buttons-wrap jd-buttons-wrap--top mt-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#View-Currency-Conversion-Details">Apply Now</button>
                </div>

                <div class="ats-description">
                    {!! $data->discription !!}
              
                  
                </div>
        
                <div class="jd-buttons-wrap jd-buttons-wrap--top">
                     <button type="button" class="btn btn-primary">Apply Now</button>
                
                
                        <button class="js-save-job-btn" data-a11y-saved-button="" data-job-id="61243199392" data-org-id="430" role="button" aria-label="Save Job" aria-pressed="false" data-job-saved="false">
                        <span class="saved">Remove From Saved Jobs</span>
                        <span class="not-saved">Save Job</span>
                    </button>
                </div>


           </section>
        </div>

</main>
<!-- Modal View Currency Conversion Details -->
<div class="modal modal-2 fade" id="View-Currency-Conversion-Details" tabindex="-1" aria-labelledby="View-Currency-Conversion-Details-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mb-2">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pt-5">
                <h2 >Fill form to apply job</h2>
              
                    <form action="{{route('company.applyJob')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="CV" class="form-label">Upload CV</label>
                            <input class="form-control" type="file" id="CV" name="cv" required>
                        </div>
                        <button type="submit" class="btn btn-secondary float-end" >Apply Now</button>
                    </form>
                
            </div>
         
        </div>
    </div>
</div>
@endsection