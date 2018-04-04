<?php

require_once("scripts/connect.php");
require_once("classes/UserManager.php");
require_once("classes/PostManager.php");
require_once("classes/Post.php");

$usermanager = new UserManager($connect,true);

if($usermanager->isLogedIn){
	$postmanager = new PostManager($connect,$usermanager,true);
}

$posts = getAllPosts($connect);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>DragMedia</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="css/framework.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<?php if(!$usermanager->isLogedIn){ ?>
		<script src="javascript/loginPanel.js" type="text/javascript"></script>
		<?php }else{ ?>
		<script src="javascript/searchField.js" type="text/javascript"></script>
		<?php } ?>
	</head>
	<body>

		<?php require_once("include/topbar.php"); ?>

		<?php $user = getUserById($connect,1);
		if(!$usermanager->isLogedIn){ ?>
		<div class="welcomeMessage">
			<h1>Welcome to my website</h1>
			<p>Welcome to DRAGMEDIA i made this site for a school project.<br>
			The objective i am aiming at with this site is too make it almost exactly like the main part of facebook.<br>
			I hope you enjoy this new social platform.<br>
			Greetings, <?php echo $user->first_name." ".$user->last_name; ?></p>
		</div>
		<?php } ?>

		<?php
		if(!$usermanager->isLogedIn){
			require_once("include/registerPanel.php");
		} ?>

		<?php if($usermanager->isLogedIn){ ?>
		<div class="postArea">
			<form action="index.php" method="POST">
				<table>
					<tr>
						<td><input type="text" name="postTitle" placeholder="POST TITLE"></td>
					</tr>
					<tr>
						<td><textarea name="postContent" placeholder="POST CONTENT" maxlength="255"></textarea></td>
					</tr>
					<tr>
						<td><button type="submit" name="post">Post</button><td>
					</tr>
				</table>
			</form>
		</div>
		<?php } ?>

		<?php if($usermanager->isLogedIn){ 
		include_once("include/postPanel.php");
		} ?>

	</body>
</html>