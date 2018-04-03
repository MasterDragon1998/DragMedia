<?php

require("connect.php");
$searchResults = array();

$name = $connect->real_escape_string($_GET["name"]);

function checkIfAlreadyFound($searcharray,$username){
	$alreadyFound = false;
	foreach($searcharray as $searchresult){
		if($searchresult["username"]==$username){
			$alreadyFound = true;
		}
	}
	return $alreadyFound;
}

$result = $connect->query("SELECT * FROM user WHERE first_name LIKE '%$name%'");
if($result){
	while($row = $result->fetch_assoc()){
		if(!checkIfAlreadyFound($searchResults,$row["username"])){
			array_push($searchResults,array("username"=>$row["username"],"first_name"=>$row["first_name"],"last_name"=>$row["last_name"]));
		}
	}
}

$result = $connect->query("SELECT * FROM user WHERE last_name LIKE '%$name%'");
if($result){
	while($row = $result->fetch_assoc()){
		if(!checkIfAlreadyFound($searchResults,$row["username"])){
			array_push($searchResults,array("username"=>$row["username"],"first_name"=>$row["first_name"],"last_name"=>$row["last_name"]));
		}
	}
}

$result = $connect->query("SELECT * FROM user WHERE username LIKE '%$name%'");
if($result){
	while($row = $result->fetch_assoc()){
		if(!checkIfAlreadyFound($searchResults,$row["username"])){
			array_push($searchResults,array("username"=>$row["username"],"first_name"=>$row["first_name"],"last_name"=>$row["last_name"]));
		}
	}
}

echo json_encode($searchResults);

?>