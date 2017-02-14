var peopleArr;

function getData() {
	// will get the data from the JSON file - data is the type of information it's getting
	$.getJSON('http://localhost:8000/data.json', function(data) {
       	
       	// output the data into the table
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

function newGame() {
	console.log("new, " peopleArr);	
}

function quit() {
	console.log("quit");

}