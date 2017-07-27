var mon = '{{ $statistics['month'] }}';
var serie = '{{ json_encode($statistics['dailypatients']) }}';
var data = {
        labels: [{{$statistics['daysinamonth']}}],
        series: [JSON.parse([serie])],
        };
var options = {
        low: -2,
        showArea: false      
        };
;
new Chartist.Line('.ct-chart', data, options);