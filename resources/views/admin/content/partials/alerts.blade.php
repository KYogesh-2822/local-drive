@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <strong>Please correct the following:</strong>
        <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
