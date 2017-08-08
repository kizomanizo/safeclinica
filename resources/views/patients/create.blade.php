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
                                @if(isset($registered))
                                    <div class="alert alert-success" id="success-alert">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>Success! </strong> {{$registered->name}} registered with number <em>{{$registered->uid}}</em>.
                                    </div>
                                @endif
                            </div>  
                            <div class="content">
                                <form role="form" method="POST" action="{{ url('patients') }}">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2">
                                            <div class="form-group">
                                                <div class="radio radio-inline">
                                                    <label>
                                                        Return
                                                        <input type="radio" name="returning" id="returning" value="1" class="form-control radio-inline" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 col-lg-10">
                                            <div class="form-group">
                                                <label for="number">Search return patient number</label>
                                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon" style="border:1px solid #a9a9a9;" border-input">Patient Number</div>
                                                    <input type="text" class="form-control border-input" id="number" name="number" placeholder="e.g. 213">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="fullname" id="fullname" class="form-control border-input"  placeholder="Full Name" required="" autofocus="" autocomplete="disabled">
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

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="region">Region</label>
                                                <select id="region" name="region" class="form-control border-input">
                                                    <option>Select a region</option>
                                                    @foreach($location['regions'] as $region)
                                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district"">District</label>
                                                <select id="district" name="district" class="form-control border-input">
                                                    <option value="">Select a district</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="village">Village(optional)</label>
                                                <input type="text" name="village" id="village" class="form-control border-input"  placeholder="Village">
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

<script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $('#region').on('change', function(e){
        console.log(e);
        var region_id = e.target.value;
 
        $.get('{{ url('patient') }}/ajaxdistricts?region_id=' + region_id, function(data) {
            console.log(data);
            $('#district').empty();
            $.each(data, function(index,subCatObj){
                $('#district').append("<option value='"+subCatObj.id+"'>"+subCatObj.name+"</option>");
            });
        });
    });
</script>
@endsection