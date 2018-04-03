<?php

require_once("classes/Country.php");

Class User{
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $email;
	public $country;
	public $birthDate;

	private $password;

	public function __construct($id,$username,$password,$first_name,$last_name,$email,$country,$birthDate){
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email = $email;
		$this->country = $country;
		$this->birthDate = new DateTime($birthDate);
	}
	public function synchronise($conn){
		$result = $conn->query("SELECT * FROM user WHERE id = '$this->id'");
		if($result){
			$row = $result->fetch_assoc();
			$this->id = $row["id"];
			$this->username = $row["username"];
			$this->password = $row["password"];
			$this->first_name = $row["first_name"];
			$this->last_name = $row["last_name"];
			$this->email = $row["email"];
			$this->country = getCountryByName($conn,$row["country"]);
			$this->birthDate = new DateTime($row["birthdate"]);
		}else{
			echo $conn->error;
		}
	}
}

function rowToUser($conn,$row){
	$country = getCountryByName($conn,$row["country"]);
	return new User($row["id"],$row["username"],$row["password"],$row["first_name"],$row["last_name"],$row["email"],$country,$row["birthdate"]);
}
function getUserById($conn,$id){
	$id = $conn->real_escape_string($id);
	$result = $conn->query("SELECT * FROM user WHERE id = '$id'");
	if($result){
		if($result->num_rows>0){
			$row = $result->fetch_assoc();
			return rowToUser($conn,$row);
		}else{
			return null;
		}
	}else{
		echo $conn->error;
	}
}
function getUserByUsername($conn,$username){
	$username = $conn->real_escape_string($username);
	$result = $conn->query("SELECT * FROM user WHERE username = '$username'");
	if($result){
		if($result->num_rows>0){
			$row = $result->fetch_assoc();
			return rowToUser($conn,$row);
		}else{
			return null;
		}
	}else{
		echo $conn->error;
	}
}

?>