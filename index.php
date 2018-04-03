<?php

require_once("scripts/connect.php");
require_once("classes/UserManager.php");

$usermanager = new UserManager($connect,true);

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

		<?php echo "<pre>"; print_r($usermanager->user); echo "</pre>"; ?>

	</body>
</html>