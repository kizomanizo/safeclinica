@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Add a service point</h4>
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
                        <form action="{{ url('services') }}" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Service Name</label>
                                    <input type="text" name="name" id="name" class="form-control border-input"  placeholder="e.g. Laboratory" required="" autofocus="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cash">Cash Payment</label>
                                    <input type="text" name="cash" id="cash" class="form-control border-input" placeholder="e.g. 3000" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="insurance">Insurance Payment</label>
                                    <input type="text" name="insurance" id="insurance" class="form-control border-input" placeholder="e.g. 5000" required="">
                                </div>
                            </div>
                            <div class="col-md-8 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    Add Service
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection