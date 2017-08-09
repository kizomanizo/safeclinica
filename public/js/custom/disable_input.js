// For the patient number field
if (document.getElementById('casetype') == '') {
	var casetype = '1';
}
else {
	var casetype = document.getElementById('casetype');
}
if (casetype) {
casetype.onchange = function() {
	    var number = document.getElementById('number');
	    if (casetype.value == '1'){
	        number.value = '';
	        number.disabled = true;
	        // console.log('switchstatus ' + casetype.value)
	    }else {
	        number.disabled = false;
	        // console.log('switchstatus ' + casetype.value)
	    }
	}
}
else {
	// console.log('NOT on registration page'+casetype)
}

// For the payment type
if (document.getElementById('payment') == '') {
	var payment = 'cash';
}
else {
	var payment = document.getElementById('payment');
}
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
	// console.log('AGAIN, not on registration page')
}