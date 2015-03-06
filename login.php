<?php
session_start();
if (isset($_SESSION['email'])) {
	header('Location: index.php');
	return;
}
if (isset($_POST['email']) || isset($_POST['password'])) {
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$errors = '<p class="error">Please fill all fields</p>';
	} else {
		require('scripts/connect.php');
		$db = open_connection();
		$email = mysql_real_escape_string($_POST['email']);
		$password = mysql_real_escape_string($_POST['password']);
		$query = "select * from user_account where email = '$email' and password = '$password' limit 1";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			mysql_close($db);
			$_SESSION['email'] = $email;
			header('Location: index.php');
			return;
		} else {
			mysql_close($db);
			//$errors = '<p class="error">Invalid credentials</p>';
		}
	}
} else {
	//unset($errors);
}
?>
<!DOCTYPE html>
<html lang="en">
        <head>
		<title>Login Page</title>
		<link type="text/stylesheet" rel="stylesheet" href="style.css">
	</head>

	<body>
		<div id="wrap">
			<header>LOGIN</header>
			<?php if (isset($errors)) { echo $errors; } ?>
			<form method="post" action="login.php">
			 
				<p><label for="email">Email:        </label><input type="text" name="email"/></p>
				<p><label for="password">Password:  </label><input type="password" name="password"/></p>
				<p><input type="submit" value="Login"/></p>
			</form>
		</div>
	</body>
</html>
