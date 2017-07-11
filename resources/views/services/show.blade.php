@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">{{$service->name}} Patients</h4>
            </div>
                <div class="content">

                @if(count($transactions) == 0)
                <div class="alert alert-warning" role="alert"">
                    <strong>Nope!</strong> There are no patients in {{ strtolower($service->name) }} service.
                </div>
                @else 
                <div class="content table-responsive table-full-width">
                
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Patient No</th>
                            <th>Patient Name</th>
                            <th>&nbsp;</th>
                            <th>Proceed to pay</th>
                            <th>Other services</th>
                        </tr>
                        </thead>
                        <tbody>


                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->patient['uid'] }}</td>
                                <td>{{ $transaction->patient['name'] }}</td>
                                <td>&nbsp;</td>
                                <td>
                                <a href="{{url('patients')}}/{{$transaction->patient['id'] }}">Release</a>
                                </td>
                                <td>
                                    Investigation | Treatment
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection