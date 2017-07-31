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
                    <table class="table table-striped table-responsive arial">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>Patient</th>
                                <th>Sex, Age</th>
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
                                <td>{{ ucfirst($patient->sex) }}, {{ $patient->age }}</td>
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
                                    <!-- Set a zero variable ya kuanzia -->
                                    @php ($bill = 0)
                                        <!-- Now loop throuth the transactions -->
                                        @foreach($patient->transactions as $transaction)
                                            @php ($bill += $transaction->type_price)
                                        @endforeach
                                    <!-- Using blade echo the results -->
                                    {{ number_format($bill) }}
                                </td>
                                <td class="text-right">
                                    @php ($paid = 0)
                                    @foreach($patient->patient_payments as $payment)
                                        @php ($paid += $payment->paid)
                                    @endforeach
                                        @if ($bill > $paid)
                                            {{ number_format($paid) }}<a href="{{ url('patients/credit/').'/'.$patient->id }}"><i class='fa fa-close text-danger'></i></a>
                                        @else
                                            {{ number_format($paid) }}<i class="fa  fa-check-circle text-success"></i><br>
                                        @endif

                                </td>
                                <td class="text-muted">{{ $patient->created_at->format('M, d') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <a href="{{ url('reports') }}" class="link">go back to the summary</a>
            </div>
        </div>
    </div>
</div>

@endsection