@extends('layouts.dashboard')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Name: {{ $patient->name }}</h4>
            </div>
                <div class="content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                        <h4>Hospital Number: <span class="courier">{{ $patient->uid }}</span></h4>
                        <strong>Patient:</strong> <span class="courier">{{ strtoupper($patient->name) }}</span><br>
                        <strong>Age:</strong> <span class="courier">{{ $patient->age }}</span><br>
                        <strong>Sex:</strong> <span class="courier">{{ strtoupper($patient->sex) }}</span><br>
                        <strong>Card Number:</strong> <span class="courier">{{ $patient->card }}</span><br>
                        <strong>Admission:</strong> <span class="courier">{{ $patient->timestamps }}</span><br>
                        </div>

                        <div class="col-lg-6 col-md-6">
                        <strong class="courier">Registration</strong>
                        @foreach($patient->services as $serv)
                        <div class="row">
                            <div class="col-md-6 courier">{{ $serv->name }}</div>
                            <div class="col-md-6 text-right courier">{{ $serv->cash }}</div>
                        </div>    
                        @endforeach
                        <hr>
                        <strong class="courier">Treatments</strong>
                        @foreach($patient->treatments as $treatment)
                        <div class="row">
                            <div class="col-md-6 courier">{{ $treatment->name }}</div>
                            <div class="col-md-6 text-right courier">{{ $treatment->price }}</div>
                        </div>    
                        @endforeach
                        <hr>
                        <strong class="courier">Investigations</strong>
                        @foreach($patient->investigations as $investigation)
                        <div class="row">
                            <div class="col-md-6 courier">{{ $investigation->name }}</div>
                            <div class="col-md-6 text-right courier">{{ $investigation->price }}</div>
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