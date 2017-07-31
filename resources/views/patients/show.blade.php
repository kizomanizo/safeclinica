@extends('layouts.dashboard')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">{{ $data['patient']['name'] }}</h4>
            </div>
                <div class="content">
                    <p>Pick an extra service</p>
                    <form role="form" method="post" action="{{ url('/patient/release') }}">
                    {{ csrf_field() }}
                    @foreach ($services as $service)
                        <div class="radio">
                            <label><input type="radio" name="service" value="{{ $service->id }}">{{ $service->name }}</label>
                        </div>
                    @endforeach
                    <hr>
                    <p>Treatments and Investigations</p>

                        <div id="treatmentArea" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 treatmentArea">
                            <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <label>Treatment</label>
                                            <input type="text" class="form-control border-input" name="treatments[]" id="treatments[]" class="form-control border-input" placeholder="type treatment name for suggestions" autofocus="" list="myTreatments" pattern="[0-9].{0,}" autocomplete="disabled">
                                            <label for="response"></label>
                                            <input type="hidden" name="response" id="response">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <label>Tablets</label>
                                            <input type="text" class="form-control border-input" name="tablets[]" id="tablets[]" class="form-control border-input" placeholder="eg. 2" pattern="[0-9].{0,}" >
                                            </div>
                                        </div>
                                    </div>
                            <datalist id="myTreatments">
                                @foreach( $data['treatments'] as $treatment)
                                    <option value="{{ $treatment['id'] }}">{{ $treatment['name'] }}</option>
                                @endforeach
                            </datalist>
                            <input type="hidden" name="patient" value="{{ $data['patient']['id'] }}">
                        </div>

                        <div id="investigationArea" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 investigationArea">
                            <label>Investigations</label>
                            <input type="text" name="investigations[]" id="investigations[]" class="form-control border-input" placeholder="start typing" list="myInvestigations" /><br>
                            <datalist id="myInvestigations">
                                @foreach($data['investigations'] as $investigation)
                                        <option value="{{ $investigation['id'] }}">{{ $investigation['name'] }}</option>
                                @endforeach
                            </datalist>
                            <input type="hidden" name="patient" value="{{ $data['patient']['id'] }}">
                        </div>
                    </div>

                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class=" form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <a href="#" class="add_field">Add another treatment</a>
                        </div>
                        <div class=" form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <a href="#" class="add_investigation">Add another investigation</a>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">Release {{ $data['patient']['name'] }}</button>
                        </div>
                        <p>&nbsp;</p>
                    </div> 

                    <div class="clearfix"></div>
                    </form>


                </div>
        </div>
    </div>
<script type="text/javascript" src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>

@endsection