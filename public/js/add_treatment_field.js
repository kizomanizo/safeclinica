$(document).ready(function() {
    var max_fields      = 10;
    var wrapper         = $(".treatmentArea");
    var add_button      = $(".add_field");
  
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="text" name="treatments[]" id="treatments[]" required="" class="form-control border-input" list="myTreatments" /><a href="#" class="delete">Delete</a><br></div>'); //add input box
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