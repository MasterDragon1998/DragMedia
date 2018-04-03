<?php

require_once("scripts/connect.php");
require_once("classes/Country.php");

$countrys = getAllCountrys($connect);

?>
<div class="registerPanel">
	<form action="index.php" method="POST" autocomplete="off">
		<table>
			<tbody>
				<tr>
					<td><label for="username">Username</label></td>
					<td colspan="2"><input type="text" name="regusername" placeholder="USERNAME" maxlength="65" required></td>
				</tr>
				<tr>
					<td><label for="first_name">Naam</label></td>
					<td><input type="text" name="first_name" placeholder="FIRST NAME" maxlength="65" required></td>
					<td><input type="text" name="last_name" placeholder="LAST NAME" maxlength="65" required></td>
				</tr>
				<tr>
					<td><label for="email">E-Mail</label></td>
					<td colspan="2"><input type="email" name="email" placeholder="E-MAIL" maxlength="65" required></td>
				</tr>
				<tr>
					<td><label for="country">Country</label></td>
					<td colspan="2">
						<select name="country">
							<?php foreach($countrys as $country){ ?>
							<option value="<?php echo $country->name; ?>"><?php echo $country->name; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="birthDate">BirthDate</label></td>
					<td colspan="2"><input type="date" name="birthDate" value="<?php $date = new DateTime(); echo ($date->format("Y")-18)."-".$date->format("m-d"); ?>" required></td>
				</tr>
				<tr>
					<td><label for="password">Password</label></td>
					<td><input type="password" name="regpassword" placeholder="PASSWORD" required></td>
					<td><input type="password" name="passwordConfirm" placeholder="PASSWORD CONFIRM" required></td>
				</tr>
				<tr>
					<td colspan="3"><button type="submit" name="register">Register</button></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>