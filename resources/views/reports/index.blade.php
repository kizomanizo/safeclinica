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
                        <!-- hidden field to hold Laravel var -->
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
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Statistical Reports</h4>
                                    </div>
                                    <div class="content">
                                        <canvas id="monthPatients" width="400" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Gender Ratio</h4>
                                    </div>
                                    <div class="content">
                                        <canvas id="monthGender" width="300" height="300"></canvas>
                                        <ul class="list-inline text-center text-muted">
                                            <li class="list-inline-item">Female: {{ $statistics['female'] }}</li>
                                            <li class="list-inline-item">Male: {{ $statistics['male'] }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Age Groups</h4>
                                    </div>
                                    <div class="content">
                                        <canvas id="monthAge" width="300" height="300"></canvas>
                                        <ul class="list-inline text-center text-muted">
                                            <li class="list-inline-item">Infants: {{ $statistics['infants'] }}</li>
                                            <li class="list-inline-item">Children: {{ $statistics['children'] }}</li>
                                            <li class="list-inline-item">Adults: {{ $statistics['adults'] }}</li>
                                            <li class="list-inline-item">The Elderly: {{ $statistics['elderly'] }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>

<!--  Charts.js required plugin -->
<script src="{{ asset('js/vendors/chartjs-2.6.0.js') }}"></script>
<script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/vendors/Chart.PieceLabel.min.js') }}"></script>
<script>
    var ctx = document.getElementById("monthPatients").getContext('2d');
    var serie = "{{ json_encode($statistics['dailypatients']) }}";
    var monthPatients = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [{{$statistics['daysinamonth']}}],
            datasets: [{
                label: 'Registered Patients',
                data: JSON.parse([serie]),
                backgroundColor:'rgba(33, 33, 32, 0.5)',
                borderColor: 'rgba(43, 135, 22, 0.5)',
                borderWidth: 1,
                hoverBackgroundColor: 'rgba(33, 33, 32, 1)',
                hoverBorderColor: 'rgba(43, 135, 22, 1)',
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        min: 0,
                        stepSize: 1
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "{{$statistics['month']}} registered patients"
                    }
                }],
                xAxes: [{
                    scaleLabel: { 
                        display: true,
                        labelString: "{{$statistics['month']}} dates"
                    }
                }]
            }
        }
    });

// And for gender doughnut chart
var ctxGender = document.getElementById("monthGender").getContext('2d');
var myDoughnutChart = new Chart(ctxGender, {
    type: 'pie',
    data: {
        datasets: [{
            data: [{{$statistics['male']}}, {{$statistics['female']}}],
            backgroundColor: [
                'rgba(80, 80, 80, 0.5)',
                'rgba(53, 53, 53, 0.8)',
            ],
            borderColor: 'rgba(43, 135, 22, 0.5)',
            borderWidth: 1,
            hoverBackgroundColor: [
                'rgba(80, 80, 80, 1)',
                'rgba(53, 53, 53, 1)',
                ],
            hoverBorderColor: "rgba(43, 135, 22, 1)",
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Male',
            'Female',
        ]
    },
    options: {
        cutoutPercentage: 70,
        pieceLabel: {
            // mode 'label', 'value' or 'percentage', default is 'percentage'
            mode: 'percentage',

            // precision for percentage, default is 0
            precision: 0,

            //identifies whether or not labels of value 0 are displayed, default is false
            showZero: true,

            // font size, default is defaultFontSize
            fontSize: 12,

            // font color, default is '#fff'
            fontColor: '#fff',

            // font style, default is defaultFontStyle
            fontStyle: 'normal',

            // font family, default is defaultFontFamily
            fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

            // draw label in arc, default is false
            arc: true,

            // position to draw label, available value is 'default', 'border' and 'outside'
            // default is 'default'
            position: 'default',

            // format text, work when mode is 'value'
            format: function (value) { 
            return '$' + value;
            }
        }
    }
});

// And for age doughnut chart
var ctxAge = document.getElementById("monthAge").getContext('2d');
var myDoughnutChart = new Chart(ctxAge, {
    type: 'pie',
    data: {
        datasets: [{
            data: [{{$statistics['infants']}}, {{$statistics['children']}}, {{$statistics['adults']}}, {{$statistics['elderly']}}],
            backgroundColor: [
                'rgba(180, 210, 220, 0.5)',
                'rgba(140, 190, 210, 0.5)',
                'rgba(80, 160, 190, 0.5)',
                'rgba(30, 90, 110, 0.5)'
            ],
            borderColor: 'rgba(43, 135, 22, 0.5)',
            borderWidth: 1,
            hoverBackgroundColor: [
                'rgba(180, 210, 220, 1)',
                'rgba(140, 190, 210, 1)',
                'rgba(80, 160, 190, 1)',
                'rgba(30, 90, 110, 1)'
                ],
            hoverBorderColor: "rgba(43, 135, 22, 1)",
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Infants',
            'Children',
            'Adults',
            'The Elderly'
        ]
    },
    options: {
        cutoutPercentage: 70,
        pieceLabel: {
            // mode 'label', 'value' or 'percentage', default is 'percentage'
            mode: 'percentage',

            // precision for percentage, default is 0
            precision: 0,

            //identifies whether or not labels of value 0 are displayed, default is false
            showZero: true,

            // font size, default is defaultFontSize
            fontSize: 12,

            // font color, default is '#fff'
            fontColor: '#fff',

            // font style, default is defaultFontStyle
            fontStyle: 'normal',

            // font family, default is defaultFontFamily
            fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",

            // draw label in arc, default is false
            arc: true,

            // position to draw label, available value is 'default', 'border' and 'outside'
            // default is 'default'
            position: 'default',

            // format text, work when mode is 'value'
            format: function (value) { 
            return '$' + value;
            }
        }
    }
});

</script>
@endsection