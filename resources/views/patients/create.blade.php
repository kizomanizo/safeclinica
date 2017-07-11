@extends('layouts.dashboard')

@section('content')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Enter patient details or number</h4>
                            </div>
                            <div class="content">
                                <form role="form" method="POST" action="{{ url('patients') }}">
                                {{ csrf_field() }}
                                     <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="number">Search return patient number</label>
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon" style="border:1px solid #a9a9a9;" border-input">enter patient number for returning patients</div>
                                                        <input type="text" class="form-control border-input" id="number" name="number" placeholder="e.g. 213">
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="fullname" id="fullname" class="form-control border-input"  placeholder="Full Name" required="" autofocus="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="text" name="age" class="form-control border-input" placeholder="Number or YYYY" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sex">Sex</label>
                                                <select class="form-control border-input" name="sex" id="sex">
                                                    <option value="female">Female</option>
                                                    <option value="male">Male</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="payment">Payment Mode</label>
                                                <select class="form-control border-input" name="payment" id="payment">
                                                    <option value="10000">Cash</option>
                                                @foreach($insurances as $insurance)
                                                    <option value="{{$insurance->id}}">{{$insurance->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div id="cardno" class="col-md-6">
                                            <div class="form-group">
                                                <label for="card">Card Number</label>
                                                <input type="text" name="card" id="card" class="form-control border-input"  placeholder="Card No" disabled="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="service">Service</label>
                                                <select class="form-control border-input" name="service" id="service">
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Register Patient</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

<script type="text/javascript" src="{{ url('js/custom/disable_input.js') }}" ></script>

@endsection