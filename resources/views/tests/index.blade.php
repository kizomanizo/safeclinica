@foreach((array) $dailypatients as $patient)
{{ $patient.',' }}
@endforeach
<br>
{{ $daysinamonth }}