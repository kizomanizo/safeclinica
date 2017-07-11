<!DOCTYPE html>
<html>
<head>
	<title>Testing fiddles</title>
</head>
<body>
Check this out | Form iko below:<br>
<form role="form" method="POST" action="" >
	<select name="payment" id="payment">
		<option value="cash">Cash</option>
		<option value="insurance">Insurance</option>
		<option value="loan">Loan</option>
	</select>
	<hr>
	<input type="text" name="card" id="card" placeholder="Enter card number" disabled="">
	<br>
	<input type="submit" name="Submit" value="Checks">

</form>


</body>
<script type="text/javascript">

var payment = document.getElementById('payment');

payment.onchange = function() {
    var mytextfield = document.getElementById('card');
    if (payment.value == 'cash'){
        mytextfield.disabled = true;
    }else {
        mytextfield.disabled = false;
    }
}
window.onload = load;
</script>
</html>