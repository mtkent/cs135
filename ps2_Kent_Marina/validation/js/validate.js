
// function that will validate multiple elements, sending messages as appropriate 
var validateField = function(fieldElem, infoMessage, validateFn) {
  // will add a span if one doesn't already exist
  if(fieldElem.parentElement.childElementCount == 1){
    $('<span></span>').insertAfter(fieldElem);
  } 

  // the span that displays the message
  var theSpan = ($(fieldElem.parentElement.children).first().next());

  // if there is no value, will display the info mesage
  if (fieldElem.value === ""){
    $(theSpan).text(infoMessage).removeClass().addClass("info");

  // otherwise will say if correct or not
  } else {
    if (! validateFn(fieldElem) ) {
      $(theSpan).text("Error").removeClass().addClass("error");
      return false;
    } else {
      $(theSpan).text("Ok").removeClass().addClass("ok");
      return true;
    }
  }

};

//will check the last two - not text inputs, and will alert if incorrect
function submitValid (fieldElem, infoMessage, validateFn) {
  if (!validateField(fieldElem, infoMessage, validateFn)) {
    var theSpan = ($(fieldElem.parentElement.children).first().next());

    $(theSpan).text("");

    alert(infoMessage);
  }

}

// checks username is only alphanumeric
function isAlphaNum (username, message) {
	return username.value.match(/^[a-z0-9]+$/i);
}

// checks password is 8 chars and has a number
function passCheck (password) {
  return (password.value.length > 7 && /\d/.test(password.value));

}

// checks phone number is 10 digits
function isPhoneNum (number) {
  var num = number.value
  return (num.match(/\d/g) && num.length === 10);
}

// checks email correct format [a-z]@[a-z].(com, gov, edu)
function isEmail (email) {
  var reg = new RegExp   (/^[a-z]+@[a-z]+\.(com|gov|edu)+$/); 

  return reg.test(email.value);
}

// checks that a radio button is pressed
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


// checks at least two checkboxes clicked
function checkChecks(field) {
  var intCount = 0
  for (var i = 0; i < field.length; i++) {
    if (field[i].checked)
     intCount++; }

   return intCount >2;
 }