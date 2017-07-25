@extends('layouts.dashboard')

@section('content')
{{ csrf_field() }}
<div class="content">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="text-muted"><i class="ti-timer"> </i>Month's Summary</h4>
            </div>
                <div class="content">
                    <div class="container-fluid">


                    <div class="row">

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="icon-big icon-info text-center">
                                            <i class="ti-wallet"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="numbers">
                                            <p>Revenue</p>
                                            {{number_format($statistics['revenue'])}}<br>
                                            <span class="tshs">TShs</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                    <i class="ti-calendar"></i> Creditors: {{number_format($statistics['creditors'])}}<span class="tshs">TShs</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="icon-big icon-warning text-center">
                                            <i class="fa fa-folder-open"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="numbers">
                                            <p>Registation</p>
                                            {{ number_format($statistics['registrations']) }}<br>
                                            <span class="tshs">TShs</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> Today: {{ number_format($statistics['todayregistrations']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="icon-big icon-success text-center">
                                            <i class="ti-pulse"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="numbers">
                                            <p>Laboratory</p>
                                            {{number_format($statistics['investigations'])}}<br>
                                            <span class="tshs">TShs</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> Today: {{number_format($statistics['todayinvestigations'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="content">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="icon-big icon-danger text-center">
                                           <i class="fa fa-medkit"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="numbers">
                                            <p> Pharmacy</p>
                                            {{number_format($statistics['treatments'])}}<br>
                                            <span class="tshs">TShs</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="footer">
                                    <hr />
                                    <div class="stats">
                                        <i class="ti-timer"></i> Today: {{number_format($statistics['todaytreatments'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Statistical Reports</h4>
                                    </div>
                                    <div class="content">
                                        <div class="ct-chart ct-perfect-fourth"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Financial Reports</h4>
                                    </div>
                                    <div class="content">
                                        Report contents 3
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Labo Reports</h4>
                                    </div>
                                    <div class="content">
                                        Reports 1
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Pharmacy Reports</h4>
                                    </div>
                                    <div class="content">
                                        Report contents 3
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/chartist.min.js') }}"></script>
<script type="text/javascript">
    var data = {
      // A labels array that can contain any sort of values
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
      // Our series array that contains series objects or in this case series data arrays
      series: [
        [5, 2, 4, 2, 0]
      ]
    };

// Create a new line chart object where as first parameter we pass in a selector
// that is resolving to our chart container element. The Second parameter
// is the actual data object.
new Chartist.Line('.ct-chart', data);
    
</script>
@endsection