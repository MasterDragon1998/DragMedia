<?php

require("classes/User.php");

Class UserManager{
	private $conn;
	public $user;
	public $sessionName = "uic";

	public $isCheckingHeaders = false;
	public $isLogedIn = false;

	public function __construct($conn,$checkHeaders){
		$this->conn = $conn;
		$this->startSession();
		if(isset($_SESSION["user"])){
			$this->user = unserialize($_SESSION["user"]);
			$this->user->synchronise($conn);
			$this->isLogedIn = true;
		}
		if($checkHeaders){
			$this->isCheckingHeaders = true;
			$this->checkHeaders();
		}
	}
	public function login($username,$password){
		$username = $this->conn->real_escape_string($username);
		$password = $this->conn->real_escape_string($password);
		$result = $this->conn->query("SELECT * FROM user WHERE username = '$username'");
		if($result){
			if($result->num_rows==1){
				$row = $result->fetch_assoc();
				if(PASSWORD_VERIFY($password,$row["password"])){
					$user = rowToUser($this->conn,$row);
					$_SESSION["user"] = serialize($user);
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function logout(){
		$_SESSION["user"] = null;
		return true;
	}
	public function register($username,$first_name,$last_name,$email,$country,$birthDate,$password,$passwordConfirm){
		$username = $this->conn->real_escape_string($username);
		$result = $this->conn->query("SELECT id FROM user WHERE username = '$username'");
		if($result){
			if($result->num_rows==0){
				if($_POST["regpassword"]==$_POST["passwordConfirm"]){
					$first_name = $this->conn->real_escape_string($first_name);
					$last_name = $this->conn->real_escape_string($last_name);
					$email = $this->conn->real_escape_string($email);
					$birthDate = $this->conn->real_escape_string($birthDate);
					$password = PASSWORD_HASH($password,PASSWORD_DEFAULT);
					$result = $this->conn->query("INSERT INTO user (username,password,first_name,last_name,email,country,birthdate) VALUES ('$username','$password','$first_name','$last_name','$email','$country','$birthDate')");
					if($result){
						return true;
					}else{
						echo $this->conn->error;
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function startSession(){
		SESSION_NAME($this->sessionName);
		if(session_id()==null){
			SESSION_START();
		}
	}
	public function checkHeaders(){
		if(isset($_POST["login"])){
			if($this->login($_POST["username"],$_POST["password"])){
				header("location:index.php");
			}
		}
		if(isset($_POST["register"])){
			if($this->register($_POST["regusername"],$_POST["first_name"],$_POST["last_name"],$_POST["email"],$_POST["country"],$_POST["birthDate"],$_POST["regpassword"],$_POST["passwordConfirm"])){
				if($this->login($_POST["regusername"],$_POST["regpassword"])){
					header("location:index.php");
				}
			}
		}
		if(isset($_POST["logout"])){
			if($this->logout()){
				header("location:index.php");
			}
		}
	}
}

?>