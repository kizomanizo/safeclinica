var payment = document.getElementById('payment');
payment.onchange = function() {
    var cardnumber = document.getElementById('card');
    if (payment.value == 'cash'){
        cardnumber.value = '';
        cardnumber.disabled = true;
    }else {
        cardnumber.disabled = false;
    }
}
window.onload = load;