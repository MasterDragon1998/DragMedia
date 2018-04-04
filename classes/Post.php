<?php

require_once("classes/User.php");

Class Post{
	public $title;
	public $content;
	public $postby;

	public function __construct($title,$content,$postby){
		$this->title = $title;
		$this->content = $content;
		$this->postby = $postby;
	}
	public function upload($conn){
		$userid = $this->postby->id;
		$result = $conn->query("INSERT INTO post (title,content,postby) VALUES ('$this->title','$this->content','$userid')");
		if($result){
			header("location:index.php");
		}else{
			echo $conn->error;
		}
	}
}

function rowToPost($conn,$row){
	return new Post($row["title"],$row["content"],getUserById($conn,$row["postby"]));
}
function getAllPosts($conn){
	$posts = array();
	$result = $conn->query("SELECT * FROM post");
	if($result){
		while($row = $result->fetch_assoc()){
			array_push($posts,rowToPost($conn,$row));
		}
		return $posts;
	}else{
		echo $conn->error;
	}
}

?>