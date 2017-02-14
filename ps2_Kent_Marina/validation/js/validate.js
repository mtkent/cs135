var validateField = function(fieldElem, infoMessage, validateFn) {
	// fieldElem can be a CSS selector, jQuery element, or DOM element - ex. passworkd, etc.
	// that represents a single form text field.
	// infoMessage should be a string that gives a human-readable
	// description of the fields requirements - message to be displayed 
	// validateFn should be a function that validates the fields value
  
// will be able to write validateField(password, error, isAlpha) and return error if needed
  if (! validateFn(fieldElem)) {
    console.log(infoMessage);
  } else {
    console.log("just fine");
  }
};

$(document).ready(function() {
	// TODO: Use validateField to validate form fields on the page.
});


function isAlphaNum (username, message) {
	return username.value.match(/^[a-z0-9]+$/i);
}


function passCheck (password) {
  return (password.value.length > 7 && /\d/.test(password.value));
   
}

function isPhoneNum (number) {
	return number.value.match(/\d/g).length===10;
}

// check for .com/other *************
function isEmail (email) {
	 var re = new RegExp(/^((?:(?:(?:\w[\.\-\+]?)*)\w)+)((?:(?:(?:\w[\.\-\+]?){0,62})\w)+)\.(\w{2,6})$/); 
    // var re = /\S+@\S+\.+/
    return re.test(email.value);
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