// external Javascript

// variables used
var counter = 0;
var redArray = [];
var blueArray = [];
var winner = "";
var clicking = true;

// whenever a cell is clicked, will check to see if game has been won, will update cell color
// this will also update the array that makes sure that only three cells/color exist
function cellClick(cell) {
  if (clicking){
    if (counter % 2 == 0 && document.getElementById(cell).style.background !== "blue" && document.getElementById(cell).style.background !== "red"){
      document.getElementById(cell).style.background = "red";
      counter++;
      redArray.push(cell);
    } else if (document.getElementById(cell).style.background !== "red" && document.getElementById(cell).style.background !== "blue"){
      document.getElementById(cell).style.background = "blue";
      counter++;
      blueArray.push(cell);
    }
    if (redArray.length > 3){
      document.getElementById(redArray[0]).style.background = "white";
      redArray.shift();
    }
    if (blueArray.length > 3){
      document.getElementById(blueArray[0]).style.background = "white";
      blueArray.shift();
    }
    console.log(blueArray);
    console.log(redArray);
  }
}

// will reset the game
// cell arrays clear, you're allowed to click again, and the background is reset 
function reset(){
  for (i = 1; i < 10; i++) { 
    document.getElementById(i).style.background = "white";
  }  
  blueArray = [];
  redArray = [];    
  clicking = true;   
  counter = 0;
}

// will check for three colors in a row - a win 
function checkWin(x, y, z){
  var colorx = document.getElementById(x).style.background;
  var colory = document.getElementById(y).style.background;
  var colorz = document.getElementById(z).style.background;

  if (colorx === colory && colorx === colorz){
    winner = document.getElementById(x).style.background;
    gameOver();
  } 
}

// if the game is over, will alert player, not allow more cells to be clicked
function gameOver(){
  if (clicking) {
    window.alert(winner + " wins!");
  }
  clicking = false;
}
