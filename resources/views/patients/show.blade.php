@extends('layouts.dashboard')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">{{ $patient->name }}</h4>
            </div>
                <div class="content">
                    <p>Pick an extra service</p>
                    <form role="form" method="post" action="{{ url('/patient/treatments') }}">
                    {{ csrf_field() }}
                    @foreach ($services as $service)
                        <div class="radio">
                            <label><input type="radio" name="service" value="{{ $service->id }}">{{ $service->name }}</label>
                        </div>
                    @endforeach
                    <hr>
                    <p>Treatments and Investigations</p>
                    <div class="row">
                        <div id="treatmentArea" class="form-group col-lg-6 treatmentArea">
                            <label>Treatments</label>
                            <input type="text" name="treatments[]" id="treatments[]" class="form-control border-input" placeholder="type treatment name for suggestions" autofocus="" list="myTreatments" /><br>
                            <datalist id="myTreatments">
                                @foreach($treatments as $treatment)
                                <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                                @endforeach
                            </datalist>
                            <input type="hidden" name="patient" value="{{ $patient->id }}">
                        </div>

                        <div id="investigationArea" class="form-group col-lg-6 investigationArea">
                            <label>Investigations</label>
                            <input type="text" name="investigations[]" id="investigations[]" class="form-control border-input" placeholder="start typing" list="myInvestigations" /><br>
                            <datalist id="myInvestigations">
                                @foreach($investigations as $investigation)
                                <option value="{{ $investigation->id }}">{{ $investigation->name }}</option>
                                @endforeach
                            </datalist>
                            <input type="hidden" name="patient" value="{{ $patient->id }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class=" form-group col-lg-6">
                            <a href="#" class="add_field">Add another treatment</a>
                        </div>
                        <div class=" form-group col-lg-6">
                            <a href="#" class="add_investigation">Add another investigation</a>
                        </div>
                    </div> 

                    <div class="text-left">
                        <button type="submit" class="btn btn-info btn-fill btn-wd">Release {{ $patient->name }}</button>
                    </div>
                    <div class="clearfix"></div>
                    </form>


                </div>
        </div>
    </div>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script language="JavaScript" src="{{ asset('js/add_treatment_field.js') }}" > </script>

</script>
@endsection