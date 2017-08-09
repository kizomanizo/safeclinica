@extends('layouts.dashboard')

@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">Name: {{ $patient->name }}</h4>
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
                        <strong>Address: </strong> <span class="courier">{{ $patient->district->name .','. $patient->village }}</span><br>
                        @endif

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h4 class="text-primary">Billed</h4>
                                <h4 class="text-primary">Paid</h4>
                                <h4>Credit</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            @php ($total = 0)
                                @php ($total += $prices['sprice'] + $prices['tprice'] + $prices['iprice'])
                                <h4 class="text-primary">{{ number_format($prices['sprice'] + $prices['tprice'] + $prices['iprice']) }}</h4>
                                @foreach($patient->patient_payments as $payment)
                                    <h4 class="text-primary">{{ number_format($payment->paid) }}</h4>
                                    @php ($total +=- $payment->paid)
                                @endforeach
                                <h4>{{ $total }}</h4>
                            </div>
                        </div>

                        </div>

                        <div class="col-lg-6 col-md-6">
                        <strong class="courier">Registration</strong>
                            @if($insurances->name == 'Cash')
                                @foreach($patient->services as $serv)
                                @if ($patient->casetype == 1)
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6 courier">{{ $serv->name }}</div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right courier">{{ number_format($serv->cash) }}</div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6 courier">{{ $serv->name }}</div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right courier">{{ number_format(($serv->cash)/2) }}</div>
                                </div>
                                @endif
                                @endforeach
                            @else
                                @foreach($patient->services as $serv)
                                @if ($patient->casetype == 1)
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6 courier">{{ $serv->name }}</div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right courier">{{ number_format($serv->insurance) }}</div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6 courier">{{ $serv->name }}</div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right courier">{{ number_format(($serv->insurance)/2) }}</div>
                                </div>
                                @endif
                                @endforeach
                            @endif
                            <div class="col-md-6 col-sm-6 col-xs-6 courier text-muted"><em>Subtotal</em></div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right courier text-muted"><em>
                                {{ number_format($prices['sprice']) }}
                            </em></div>
                        <hr>

                        @if(count($patient->treatments) > 0)
                        <strong class="courier">Treatments</strong>
                            @foreach($patient->treatments as $treatment)
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6 courier">{{ $treatment->name }}</div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right courier">{{ number_format($treatment->pivot->treatment_payment) }}</div>
                            </div>  
                            @endforeach
                            <div class="col-md-6 col-sm-6 col-xs-6 courier text-muted"><em>Subtotal</em></div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right courier text-muted"><em>{{ number_format($prices['tprice']) }}</em></div>
                        <hr>
                        @endif

                        @if(count($patient->investigations) > 0)
                        <strong class="courier">Investigations</strong>
                            @foreach($patient->investigations as $investigation)
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6 courier">{{ $investigation->name }}</div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right courier">{{ number_format($investigation->price) }}</div>
                            </div>
                            @endforeach
                                <div class="col-md-6 col-sm-6 col-xs-6 courier text-muted"><em>Subtotal</em></div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right courier text-muted"><em>{{ number_format($prices['iprice']) }}</em></div>
                        <hr>
                        @endif   
                        <div class="row">
                            <div class=" col-lg-12 col-md-6 col-sm-12 col-xs-12 form-group">
                                <form method="POST" action="{{url('patients/paycredit')}}" >
                                {{ csrf_field() }}
                                    <input type="text" class="form-control border-input" id="credit" name="credit" placeholder="make another payment">
                                    <input type="hidden" name="patient" value="{{ $patient->id }}">
                                    <br>
                                    <button class="btn btn-primary text-center">Pay again</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
        </div>
    </div>
@endsection