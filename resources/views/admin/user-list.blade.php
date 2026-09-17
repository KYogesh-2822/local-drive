@extends("layouts.admin.header-content")
@section('content')
<section class="dashboard">
    <div class="common-heading">
        <h1>Enquire Form List</h1>
    </div>
    <div class="">
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Primary Contact Name</th>
                <th>Email address</th>
                <th>Phone number</th>
                <th>Type of vehicle</th>
                <th>Dates</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="text-capitalize">{{$user->name ?? ''}}</td>
                <td>{{$user->email ?? ''}}</td>
                <td>{{$user->phone ?? ''}}</td>
                <td>{{$user->type ?? ''}}</td>
                <td>{{date("d-M-Y", strtotime($user->date))}}</td>
            </tr>
            @endforeach
        </tbody>
 
    </table>
    </div>
</section>
<style>
.form-select-sm {
    height: auto;
}
.form-control-sm {
    height: auto;
}
div#example_filter {
    float: right;
}
ul.pagination {
    float: right;
}
</style>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    new DataTable('#example');
</script>
@endsection
