@extends('layouts.dashboard')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Name: {{ $patient->name }}.{{ $patient->id }}</h4>
            </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                        <h4>Hospital Number: {{ $patient->uid }}</h4>
                        </div>
                        <h5>Age: {{ $patient->age }}</h5>
                        <h5>Sex: {{ $patient->sex }}</h5>
                        <h5>Payment: {{ $patient->name }}</h5>
                        <h5>Card Number: {{ $patient->name }}</h5>
                        <h5>Admission: {{ $patient->name }}</h5>

                        <div class="col-lg-6 col-md-6">
                        <h5>Registration</h5>
                        @foreach($servs as $serv)
                        <div class="row">
                            <div class="col-md-6" style="font-size: 14px; font-family: 'Fira code';">{{ $serv->serv }}</div>
                            <div class="col-md-6 text-right" style="font-family: 'Fira code';">{{ $serv->cash }}</div>
                        </div>    
                        @endforeach
                        <hr>
                        <h5>Treatments</h5>
                        @foreach($treatments as $treatment)
                        <div class="row">
                            <div class="col-md-6" style="font-size: 14px; font-family: 'Fira code';">{{ $treatment->treatment }}</div>
                            <div class="col-md-6 text-right" style="font-family: 'Fira code';">{{ $treatment->price }}</div>
                        </div>    
                        @endforeach
                        <hr>
                        <h5>Treatments</h5>
                        @foreach($investigations as $investigation)
                        <div class="row">
                            <div class="col-md-6" style="font-size: 14px; font-family: 'Fira code';">{{ $investigation->investigation }}</div>
                            <div class="col-md-6 text-right" style="font-family: 'Fira code';">{{ $investigation->price }}</div>
                        </div>    
                        @endforeach

                        </div>
                    </div>
                        <a href="#" class="btn btn-primary text-center">Checkout</a>


                </div>
        </div>
    </div>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script language="JavaScript" src="{{ asset('js/add_treatment_field.js') }}" > </script>

</script>
@endsection