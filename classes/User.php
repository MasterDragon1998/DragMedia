<?php

require_once("classes/Country.php");
require_once("classes/Post.php");

Class User{
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $email;
	public $country;
	public $birthDate;
	public $posts = array();

	private $password;

	public function __construct($conn,$loadPosts = false,$id,$username,$password,$first_name,$last_name,$email,$country,$birthDate){
		$this->id = $id;
		$this->username = $username;
		$this->password = $password;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email = $email;
		$this->country = $country;
		$this->birthDate = new DateTime($birthDate);
		if($loadPosts){
			$this->getPosts($conn);
		}
	}
	public function getPosts($conn){
		$result = $conn->query("SELECT * FROM post WHERE postby = '$this->id'");
		if($result){
			while($row = $result->fetch_assoc()){
				array_push($this->posts,rowToPost($conn,$row));
			}
		}else{
			echo $conn->error;
		}
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

function rowToUser($conn,$row,$loadPosts = false){
	$country = getCountryByName($conn,$row["country"]);
	return new User($conn,$loadPosts,$row["id"],$row["username"],$row["password"],$row["first_name"],$row["last_name"],$row["email"],$country,$row["birthdate"]);
}
function getUserById($conn,$id,$loadPosts = false){
	$id = $conn->real_escape_string($id);
	$result = $conn->query("SELECT * FROM user WHERE id = '$id'");
	if($result){
		if($result->num_rows>0){
			$row = $result->fetch_assoc();
			return rowToUser($conn,$row,$loadPosts);
		}else{
			return null;
		}
	}else{
		echo $conn->error;
	}
}
function getUserByUsername($conn,$username,$loadPosts = false){
	$username = $conn->real_escape_string($username);
	$result = $conn->query("SELECT * FROM user WHERE username = '$username'");
	if($result){
		if($result->num_rows>0){
			$row = $result->fetch_assoc();
			return rowToUser($conn,$row,$loadPosts);
		}else{
			return null;
		}
	}else{
		echo $conn->error;
	}
}

?>