@extends('layouts.dashboard')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Name: {{ $patient->name }}</h4>
            </div>
                <div class="content">
                    <p><div class="row">
                        <div class="col-lg-6 col-md-6">
                        <h4><span class="courier">{{ $patient->name }}</span></h4>
                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient['uid'], 'C39', 1,20)}}" alt="barcode" /><br>
                        <strong>Patient: </strong> <span class="courier">{{ strtoupper($patient->uid) }}</span><br>
                        <strong>Age: </strong> <span class="courier">{{ $patient->age }}</span><br>
                        <strong>Sex: </strong> <span class="courier">{{ strtoupper($patient->sex) }}</span><br>
                        @if($insurances->name == 'Cash')
                        <strong>Payment Mode: </strong><span class="courier">{{ strtoupper('Cash') }}</span><br>
                        @else
                        <strong>Payment Mode: </strong><span class="courier">{{ strtoupper('Insurance') }}</span><br>
                        <strong>Insurer: </strong> <span class="courier">{{ strtoupper($insurances->name) }}</span><br>
                        <strong>Card No: </strong> <span class="courier">{{ $insurances->pivot->card }}</span><br>
                        @endif
                        <strong>Address: </strong> <span class="courier">{{ $patient->district->name .', '. $patient->village }}</span><br>
                        </div>

                        <div class="col-lg-6 col-md-6">
                        <strong class="courier">Registration</strong>
                            @if($insurances->name == 'Cash')
                                @foreach($patient->services as $serv)
                                <div class="row">
                                    <div class="col-md-6 courier">{{ $serv->name }}</div>
                                    <div class="col-md-6 text-right courier">{{ number_format($serv->cash) }}</div>
                                </div>    
                                @endforeach
                            @else
                                @foreach($patient->services as $serv)
                                <div class="row">
                                    <div class="col-md-6 courier">{{ $serv->name }}</div>
                                    <div class="col-md-6 text-right courier">{{ number_format($serv->insurance) }}</div>
                                </div>    
                                @endforeach
                            @endif
                            <div class="col-md-6 courier text-muted"><em>Subtotal</em></div>
                            <div class="col-md-6 text-right courier text-muted"><em>{{ number_format($prices['sprice']) }}</em></div>
                        <hr>

                        @if(count($patient->treatments) > 0)
                        <strong class="courier">Treatments</strong>
                            @foreach($patient->treatments as $treatment)
                            <div class="row">
                                <div class="col-md-6 courier">{{ $treatment->name }}</div>
                                <div class="col-md-6 text-right courier">{{ number_format($treatment->pivot->treatment_payment) }}</div>
                            </div>  
                            @endforeach
                            <div class="col-md-6 courier text-muted"><em>Subtotal</em></div>
                            <div class="col-md-6 text-right courier text-muted"><em>{{ number_format($prices['tprice']) }}</em></div>
                        <hr>
                        @endif

                        @if(count($patient->investigations) > 0)
                        <strong class="courier">Investigations</strong>
                            @foreach($patient->investigations as $investigation)
                            <div class="row">
                                <div class="col-md-6 courier">{{ $investigation->name }}</div>
                                <div class="col-md-6 text-right courier">{{ number_format($investigation->price) }}</div>
                            </div>
                            @endforeach
                                <div class="col-md-6 courier text-muted"><em>Subtotal</em></div>
                                <div class="col-md-6 text-right courier text-muted"><em>{{ number_format($prices['iprice']) }}</em></div>
                        </hr>
                        @endif   
                        <div class="row">
                                <div class="col-md-6"><h4 class="courier">Total</h4></div>
                                <div class="col-md-6 text-right"><h4 class="courier">{{ number_format($prices['sprice'] + $prices['tprice'] + $prices['iprice']) }}</h4></div>
                        </div>

                    <form method="POST" action="{{url('patient/transactions')}}" >
                                <div id="paymentArea" class="form-group col-lg-8 paymentArea">
                                    
                                </div>
                        <a href="#" class="add_payment">Pay less amount</a>
                        </div>
                    </div></p>
                        {{ csrf_field() }}
                        <input type="hidden" name="patient" value="{{ $patient->id }}">

                        @foreach($patient->services as $serv)
                            <input type="hidden" id="services[]" name="services[]" value="{{ $serv->id }}">
                        @endforeach

                        @foreach($patient->treatments as $treatment)
                            <input type="hidden" id="treatments[]" name="treatments[]" value="{{ $treatment->id }}">
                        @endforeach

                        @foreach($patient->investigations as $investigation)
                            <input type="hidden" id="investigations[]" name="investigations[]" value="{{ $investigation->id }}">
                        @endforeach
                        <input type="hidden" name="payment" value="{{ $prices['sprice'] + $prices['tprice'] + $prices['iprice'] }}">
                        <button class="btn btn-primary text-center">Checkout</button>
                    </form>
                </div>
        </div>
    </div>
@endsection