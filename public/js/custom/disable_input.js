// For the payment type
if (document.getElementById('payment') == '') { var payment = 'cash'; }
else { var payment = document.getElementById('payment'); }
if (payment) {
	payment.onchange = function() {
	    var cardnumber = document.getElementById('card');
	    if (payment.value == 'cash'){
	        cardnumber.value = '';
	        cardnumber.disabled = true;
	    }else {
	        cardnumber.disabled = false;
	    }
	}
}
else {
	console.log('not on registration page')
}

// For the patient number field
if (document.getElementById('returning') == '') { var returning = '0'; }
else { var returning = document.getElementById('returning'); }
if (returning) {
returning.onchange = function() {
	    var number = document.getElementById('number');
	    if (returning.value == '0'){
	        number.value = '';
	        number.disabled = true;
	    }else {
	        number.disabled = false;
	    }
	}
}
else {
	console.log('again, not on registration page')
}