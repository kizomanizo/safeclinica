@extends('layouts.dashboard')

@section('content')
{{ csrf_field() }}
<div class="content">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted"><i class="ti-timer"> </i>{{ date('F') }}'s Full Summary</h4>
            </div>
            <div class="content">
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>Patient</th>
                                <th>Sex | Age</th>
                                <th>Address</th>
                                <th>Ward</th>
                                <th>Investigations</th>
                                <th>Treatments</th>
                                <th>Bill</th>
                                <th>Paid</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{ $patient->uid }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->sex }} | {{ $patient->age }}</td>
                                <td>{{ $patient->district->name }}, {{ $patient->village }}</td>
                                <td>
                                    @foreach($patient->services as $service)
                                        {{ $service->name }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($patient->investigations as $investigation)
                                        {{ $investigation->name }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($patient->treatments as $treatment)
                                        {{ $treatment->name }}<br>
                                    @endforeach
                                </td>
                                <td class="text-muted">
                                    @foreach($patient->treatments as $treatment)
                                        {{ $treatment->pivot->treatment_payment }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($patient->patient_payments as $payment)
                                        {{ $payment->paid }}<br>
                                    @endforeach
                                </td>
                                <td class="text-muted">{{ $patient->created_at->format('F,-d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <a href="{{ url('reports') }}" class="link">go back to the summary</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection