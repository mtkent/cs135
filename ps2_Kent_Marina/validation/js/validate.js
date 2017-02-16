var validateField = function(fieldElem, infoMessage, validateFn) {
	// fieldElem can be a CSS selector, jQuery element, or DOM element - ex. passworkd, etc.
	// that represents a single form text field.
	// infoMessage should be a string that gives a human-readable
	// description of the fields requirements - message to be displayed 
	// validateFn should be a function that validates the fields value
// will be able to write validateField(password, error, isAlpha) and return error if needed
  if (fieldElem.value === ""){
     $('<span id="span1" class="info">infoMessage</span>').insertAfter(fieldElem);

  } else {
     if (! validateFn(fieldElem)) {
        console.log("should be error");
        $('#frmRegister #span1').removeClass('info').addClass('error');
        // $('<span class="error">Error</span>').insertAfter(fieldElem);
        // var x = document.getElementById(fieldElem).nextSibling.innerHTML;
          // console.log(x);
        // document.getElementById(fieldElem.id).focus();

        console.log(infoMessage);
      } else {
        $('<span class="ok">Ok</span>').insertAfter(fieldElem);
      }
  }
 
};


// function vMinimumLength (control, length, errormessage) {
//     var error="";
//     document.getElementById(control.id).nextSibling.innerHTML="";
//     if (control.value.length < length) {
//       error = errormessage;
//       document.getElementById(control.id).nextSibling.innerHTML=errormessage;
//       document.getElementById(control.id).focus();
//       }
//     return error;
//     }


function isAlphaNum (username, message) {
	return username.value.match(/^[a-z0-9]+$/i);
}


function passCheck (password) {
  return (password.value.length > 7 && /\d/.test(password.value));
   
}

function isPhoneNum (number) {
  var num = number.value
	return (num.match(/\d/g) && num.length === 10);
}

// check for .com/other *************
function isEmail (email) {
  var reg = new RegExp   (/^[a-z]+@[a-z]+\.(com|gov|edu)+$/); 

  return reg.test(email.value);
}

function radioCheck(form) {
    console.log("form " + form );

    var radioButtons = form.radColleges;
    radioChosen = false;
    for (var i=0; i<radioButtons.length; i++) {
     if (radioButtons[i].checked)
      {
        radioChosen=true;
      }
    }

    return radioChosen;
}

function checkChecks(field) {
  var intCount = 0
  for (var i = 0; i < field.length; i++) {
	     if (field[i].checked)
         intCount++; }

  return intCount >2;
}