
function searchFieldSubmit(input){
	console.log(input);
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200){
			createSearchResultTable(JSON.parse(this.responseText));
		}
	}
	xhttp.open("GET","scripts/getUsersLike.php?name="+input,true);
	xhttp.send();
	return false;
}

function createSearchResultTable(input){
	var table = document.createElement("table");
	for(i=0;i<input.length;i++){
		tr = document.createElement("tr");
		td = document.createElement("td");
		a = document.createElement("a");
		a.innerHTML = input[i]["first_name"]+" "+input[i]["last_name"]+" ("+input[i]["username"]+")";
		a.setAttribute("href","user.php?username="+input[i]["username"]);
		td.appendChild(a);
		tr.appendChild(td);
		table.appendChild(tr);
	}
	var searchResultPanel = document.getElementById("searchResultPanel");
	searchResultPanel.innerHTML = "";
	searchResultPanel.appendChild(table);
}