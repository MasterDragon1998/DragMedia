<?php

require_once("scripts/connect.php");
require_once("classes/UserManager.php");

$usermanager = new UserManager($connect,true);

if(!$usermanager->isLogedIn){
	header("location:index.php");
}
if(isset($_GET["username"])){
	$user = getUserByUsername($connect,$_GET["username"]);
	if(!$user){
		header("location:index.php");
	}
}else{
	header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>DragMedia</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">

		<link rel="stylesheet" type="text/css" href="css/framework.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<?php if($usermanager->isLogedIn){ ?>
		<script src="javascript/searchField.js" type="text/javascript"></script>
		<?php } ?>
	</head>
	<body>

	<?php require_once("include/topbar.php"); ?>

	<div class="userProfilePanel">
		<h1><?php echo $user->first_name." ".$user->last_name; ?> (A.K.A <?php echo $user->username; ?>)</h1>
	</div>

	</body>
</html>