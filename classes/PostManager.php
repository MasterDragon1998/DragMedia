<?php

require_once("classes/Post.php");

Class PostManager{
	public $conn;
	public $usermanager;
	public $checkingHeaders = false;

	public function __construct($conn,$usermanager,$checkHeaders){
		$this->conn = $conn;
		$this->usermanager = $usermanager;
		if($checkHeaders){
			$this->checkHeaders();
			$this->checkingHeaders = true;
		}
	}
	public function checkHeaders(){
		if(isset($_POST["post"])){
			$post = new Post($_POST["postTitle"],$_POST["postContent"],$this->usermanager->user);
			$post->upload($this->conn);
		}
	}
}

?>