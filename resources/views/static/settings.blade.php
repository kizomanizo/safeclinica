@extends('layouts.dashboard')

@section('content')
{{ csrf_field() }}
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Select settings to configure</h4>
            </div>
            <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="row">
                    <div class="col-md-6">
                        <p><i class="fa fa-medkit"></i> Services:</p>
                        <ul>
                            <li><a href="{{ url('services/create') }}">Add Services</a></li>
                            <li><a href="{{ url('services') }}">Edit Services</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fa fa-cc-visa"></i> Insurance Companies:</p>
                        <ul>
                            <li><a href="{{ url('insurances/create') }}">Add Insurances</a></li>
                            <li><a href="{{ url('insurances') }}">Edit Insurances</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">   
                        <p><i class="fa fa-flask"></i> Laboratory &amp; Investigations:</p>
                        <ul>
                            <li><a href="{{ url('investigations/create') }}">Add Lab &amp; Investigations</a></li>
                            <li><a href="{{ url('investigations') }}">Edit Lab &amp; Investigations</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <p><i class="fa fa-wheelchair"></i> Treatments:</p>
                        <ul>
                            <li><a href="{{ url('treatments/create') }}">Add Treatments</a></li>
                            <li><a href="{{ url('treatments') }}">Edit Treatments</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">   
                        <p><i class="fa fa-user"></i> Users</p>
                        <ul>
                            <li><a href="{{ url('users/create') }}">Add a new user</a></li>
                            <li><a href="{{ url('users') }}">Edit Existing Users</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                    <!-- Logo uploading area -->
                    <p><i class="fa fa-file-image-o"></i> Upload Company Logo</p>
                    <form role="form" method="POST" action="{{ url('logo/upload') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <input type="file" name="logo" id="logo" class="form-control border-input">
                        <br>
                        <button type="submit" class="btn btn-warning">Upload</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection