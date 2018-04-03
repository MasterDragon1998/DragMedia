<div class="topbar col-12">
	<a href="index.php"><img src="images/dragmedia.png"></a>
	<?php if($usermanager->isLogedIn){ ?>
	<form class="searchField" action="index.php" method="GET" onsubmit="return searchFieldSubmit(this.elements[0].value)">
		<input id="searchField" type="text" name="searchField" placeholder="SEARCHBAR" autocomplete="off" onkeyup="searchFieldSubmit(this.value)" value="<?php if(isset($_COOKIE["searchText"])){ echo $_COOKIE["searchText"];  } ?>">
		<div id="searchResultPanel"></div>
	</form>
	<form class="logoutForm" action="index.php" method="POST"><button class="logoutButton" type="submit" name="logout">Logout</button></form>
	<h1><a href="user.php?username=<?php echo $usermanager->user->username; ?>"><?php echo $usermanager->user->first_name." ".$usermanager->user->last_name; ?></a></h1>
	<?php }else{ ?>
	<button class="loginButton" onclick="loginPanel.toggle()">Login</button>
	<?php } ?>
</div>
<?php if(!$usermanager->isLogedIn){ ?>
<div id="loginPanel" class="col-3">
	<form action="index.php" method="POST">
		<table>
			<tbody>
				<tr>
					<td><label for="username">Username:</label></td>
					<td><input type="text" name="username" required autofocus></td>
				</tr>
				<tr>
					<td><label for="password">Password:</label></td>
					<td><input type="password" name="password" required></td>
				</tr>
				<tr>
					<td colspan="2"><button type="submit" name="login">Login</button></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php } ?>