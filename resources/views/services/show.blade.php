@extends('layouts.dashboard')

@section('content')
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted">{{$service->name}} Patients</h4>
            </div>
                <div class="content">

                @if(count($patients) == 0)
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
                            <th>Age, Sex</th>
                            <th>Proceed to pay</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                            <tr>
                                <td class="courier">{{ $patient['uid'] }}</td>
                                <td>{{ $patient['name'] }}</td>
                                <td>{{ ucfirst($patient->sex) .', '. $patient->age }}</td>
                                <td><a href="{{url('patients')}}/{{$patient['id'] }}">Proceed</a></td>
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