var validateField = function(fieldElem, infoMessage, validateFn) {

  if(fieldElem.parentElement.childElementCount == 1){
    $('<span></span>').insertAfter(fieldElem);
  } 

  var theSpan = ($(fieldElem.parentElement.children).first().next());

  if (fieldElem.value === ""){
    $(theSpan).text(infoMessage);
    $(theSpan).text(infoMessage).removeClass().addClass("info");


  } else {
     if (! validateFn(fieldElem) ) {
        $(theSpan).text("Error");
        $(theSpan).text("Error").removeClass().addClass("error");
        return false;
      } else {
        $(theSpan).text("Ok");
        $(theSpan).text("Ok").removeClass().addClass("ok");
        return true;
      }
  }
 
};

function submitValid (fieldElem, infoMessage, validateFn) {
  if (!validateField(fieldElem, infoMessage, validateFn)) {
    var theSpan = ($(fieldElem.parentElement.children).first().next());

    $(theSpan).text("");
    
    alert(infoMessage);
  }

}

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