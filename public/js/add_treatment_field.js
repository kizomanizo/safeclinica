$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".treatmentArea");
    var add_button      = $(".add_field");
  
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="row"><div class=" col-lg-9 col-md-9 col-sm-8 col-xs-8"><div class="form-group"><input type="text" class="form-control border-input" required="" name="treatments[]" id="treatments[]" list="myTreatments"></div></div><div class="col-md-3 col-lg-3 col-sm-4 col-xs-4"><div class="form-group"><input type="text" class="form-control border-input"  required="" name="tablets[]" id="tablets[]" ></div></div></div></div><a href="#" class="delete">Delete</a><br></div>'); //add input box
        }
  else
  {
  alert('You have reached the maximum number of treatments')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".investigationArea");
    var add_button      = $(".add_investigation");
  
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="text" name="investigations[]" id="investigations[]" required="" class="form-control border-input" list="myInvestigations" /><a href="#" class="delete">Delete</a><br></div>'); //add input box
        }
  else
  {
  alert('You have reached the maximum number of investigations')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

$(document).ready(function() {
    var max_fields      = 2;
    var wrapper         = $(".paymentArea");
    var add_button      = $(".add_payment");

    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="text" name="paidamount" id="paidamount" placeholder="Enter paid amount e.g 9000" class="form-control border-input" /><br></div>'); //add input box
            $(add_button).remove(); x--;
        }
  else
  {
  alert('Only one adjustment allowed!')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});