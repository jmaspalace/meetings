$(document).ready(function() {


//encontramos los submit, para que al primero se le agregue una clase especial para el color del css



//Video


//$(document).ready(function() {
 // document.getElementsByClassName('banner-mobile')[0].childNodes[1].childNodes[3].setAttribute('target','blank');
  //document.getElementsByClassName('slides')[0].childNodes[3].childNodes[3].removeChild(document.getElementsByClassName('slides')[0].childNodes[3].childNodes[3].childNodes[1]);
//});

if( $('.banner-mobile').length )  {
 document.getElementsByClassName('banner-mobile')[0].childNodes[1].childNodes[3].setAttribute('target','blank');
  //document.getElementsByClassName('slides')[0].childNodes[3].childNodes[3].removeChild(document.getElementsByClassName('slides')[0].childNodes[3].childNodes[3].childNodes[1]);

}

//form

if( $('.ocultar').length )  {
 $('.webform-submit').prop('disabled', false);
}else {
  $('.webform-submit').prop('disabled', true);
   // $('#edit-submitted-f6-check-out').prop('disabled', true);
}


    





$("#edit-submitted-f6-check-out").change(function() {
  var msg_validate = "no l";

 	if( $('.webform-client-form-210').length )  {
     msg_validate = "The date of CHECK IN can't be higher than the CHECK OUT date.";
	} else {
     msg_validate = "La fecha de INGRESO no puede ser mayor a la fecha de SALIDA.";
	}

	var fecha_in = $('.check_in_input').val();
  	var fecha_out = $(this).val();

	var d = new Date(fecha_in);
	var d2 = new Date(fecha_out);

  	if (d > d2) {
  		$('.webform-submit').prop('disabled', true);
  		alert(msg_validate);
      var a = $('#webform-client-form-692 > div > .form-actions > .form-submit');
$(a).prop('disabled', false)
  		
	}else {
		$('.webform-submit').prop('disabled', false);
    var a = $('#webform-client-form-692 > div > .form-actions > .form-submit');
$(a).prop('disabled', false)
	}

});


$("#edit-submitted-f6-check-in").change(function() {
  var msg_validate = "no l";

 	if( $('.webform-client-form-210').length )  {
     msg_validate = "The date of CHECK IN can't be higher than the CHECK OUT date.";
	} else {
     msg_validate = "La fecha de INGRESO no puede ser mayor a la fecha de SALIDA.";
	}

	var fecha_out = $('.check_out_input').val();
  	var fecha_in = $(this).val();

  	if (fecha_out != ""){

	var d = new Date(fecha_in);
	var d2 = new Date(fecha_out);


 	if (d > d2) {
  		$('.webform-submit').prop('disabled', true);
  		alert(msg_validate);
      var a = $('#webform-client-form-692 > div > .form-actions > .form-submit');
$(a).prop('disabled', false)
  		
	}else {
		$('.webform-submit').prop('disabled', false);
    var a = $('#webform-client-form-692 > div > .form-actions > .form-submit');
$(a).prop('disabled', false)
	}
	}




});

//al existir 2 forms, se bloquean los 2 por la validacion, busamos el primero y ejecutamos
var a = $('#webform-client-form-692 > div > .form-actions > .form-submit');
$(a).prop('disabled', false)

var b = $('#webform-client-form-695 > div > .form-actions > .form-submit');
$(b).prop('disabled', false)



/*var buttons = '<button class="webform-submit button-primary btn btn-primary form-submit" type="submit" name="op" value="Submit">Submit</button>';


$( ".form-managed-file" ).append(buttons );*/

////

});


//ENG, webform-client-form webform-client-form-210

//ESP, webform-client-form webform-client-form-643




