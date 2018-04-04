<?php

Class Country{
	public $name;
	public $img_path;

	public function __construct($name,$path){
		$this->name = $name;
		$this->img_path = $path;
	}
}

function rowToCountry($row){
	return new Country($row["name"],$row["img_path"]);
}
function getAllCountrys($conn){
	$result = $conn->query("SELECT * FROM country");
	if($result){
		$countrys = array();
		while($row = $result->fetch_assoc()){
			array_push($countrys, rowToCountry($row));
		}
		return $countrys;
	}else{
		$conn->error;
	}
}
function getCountryById($conn,$id){
	$id = $conn->real_escape_string($id);
	$result = $conn->query("SELECT * FROM country WHERE id = '$id'");
	if($result){
		$row = $result->fetch_assoc();
		return rowToCountry($row);
	}else{
		echo $conn->error;
	}
}
function getCountryByName($conn,$country){
	$country = $conn->real_escape_string($country);
	$result = $conn->query("SELECT * FROM country WHERE name = '$country'");
	if($result){
		$row = $result->fetch_assoc();
		return rowToCountry($row);
	}else{
		echo $conn->error;
	}
}

?>