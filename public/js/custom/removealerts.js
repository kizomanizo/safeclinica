$(document).ready(function () {
 
window.setTimeout(function() {
    $("#success-alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
 
});