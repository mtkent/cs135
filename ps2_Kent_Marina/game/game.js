// the array of data
var peopleArr;

// whether the game is over
var gameover = true;

// this function will fetch the data from teh json file
function getData() {
	// will get the data from the JSON file - data is the type of information it's getting
	$.getJSON('http://localhost:8000/data.json', function(data) {
       	
       	// output the data into the table - not currently being used, but maybe helpful for future implementation
        var output="<table class='table table-hover'>";
        output += "<tr> " +
        		  "<th> First name </th> " +
        		  "<th> Last name </th>" + 
        		  "<th> Picture </th> " + 
        		  "</tr> ";
        for (var i in data.people) {
            output+=  "<td>" + data.people[i].firstname + " </td> " + 
                      "<td>" + data.people[i].lastname + " </td> " + 
                      "<td>" + "<img width='20%' height='20%' src='images/" + data.people[i].image + "'/>" + " </td> " + 
                      "</tr>" ;
        }

        output+="</table>";
        $("#placeholder").html(output );;
        peopleArr = data;
    });

}


// the current person we're looking at
var count = 0;  

// displays the image on the site
function showImage(){
  if (! gameover) {
    var pic = peopleArr.people[count].image;
    var image = document.getElementById('myImage');  
    image.src = "profilePics/" + pic;
    displayOptions();

    count++;

    // will stop playing once we're done with all people
    if (count === 15){
      count = 0;
      quit();
    }
  }
}

// the correct answer to click on in the table
var rightCell;

// will display name options for the game
function displayOptions() {
  var ran =Math.floor(Math.random() * 3);
  var id = "slot" + ran;
  rightCell = id;
  var id1 = "slot" + ((ran + 1) % 3);
  var id2 = "slot" + ((ran + 2) % 3);

  var ans = document.getElementById(id);
  var ans1 = document.getElementById(id1);
  var ans2 = document.getElementById(id2);

  answer = peopleArr.people[count].firstname + " " + peopleArr.people[count].lastname;

  randomPerson1 = (count + 8) % 15;
  randomPerson2 = (count + 3) % 15;
  fake1 = peopleArr.people[randomPerson1].firstname + " " + peopleArr.people[randomPerson1].lastname;
  fake2 = peopleArr.people[randomPerson2].firstname + " " + peopleArr.people[randomPerson2].lastname;


  ans.innerHTML = answer;
  ans1.innerHTML = fake1;
  ans2.innerHTML = fake2;

// will reset to original after game done
  if (gameover){
    document.getElementById("slot0").innerHTML = "Option 1";
    document.getElementById("slot1").innerHTML = "Option 2";
    document.getElementById("slot2").innerHTML = "Option 3" ;
  }
}

// the scores
var right = 0;
var wrong = 0;
var highscore = 0;

// checks if the right cell was clicked, will tell you if you got the right one or not
function isRight (cell) {
  if (!gameover) {
    if (cell.id === rightCell){
      right++;
      document.getElementById("rightscore").innerHTML = "Right: " + right; 
      alert("Correct, good job!");
    } else {
      wrong++;
      document.getElementById("wrongscore").innerHTML = "Wrong: " + wrong; 
      var nope = "Sorry, that is incorrect. The right name is: " + document.getElementById(rightCell).innerHTML;
      alert(nope);


    }
    showImage();

  }

}

// will start a new game
function newGame() {
    if (gameover) {
      gameover = false;
      count = 0;
      updateScore();
  	  showImage();
  }
}

// will quit a game 
function quit() {
	var image = document.getElementById('myImage');  
  image.src = "";
  image.alt = "Game Over! Press New Game to play again!"
  gameover = true;
  displayOptions();
}

// will update the scores on the page, will also alert you to a high score 
function updateScore() {  
  if (right > highscore){
    highscore = right;
    document.getElementById("highscore").innerHTML = "Highscore: " + highscore; 
    alert("You're getting better, you beat your high score!")
  }
  right = 0;
  document.getElementById("rightscore").innerHTML = "Right: " + right; 

  wrong = 0;
  document.getElementById("wrongscore").innerHTML = "Wrong: " + wrong; 
}