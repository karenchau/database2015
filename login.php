<?php
session_start();
if (isset($_SESSION['username'])) {
	header('Location: index.php');
	return;
}
if (isset($_POST['username']) || isset($_POST['password'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$errors = '<p class="error">Please fill all fields</p>';
	} else {
		require('scripts/connect.php');
		$db = open_connection();
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		$query = "select * from user where username = '$username' and password = '$password' limit 1";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			mysql_close($db);
			$_SESSION['username'] = $username;
			header('Location: index.php');
			return;
		} else {
			mysql_close($db);
			$errors = '<p class="error">Invalid credentials</p>';
		}
	}
} else {
	unset($errors);
}
?>
<!DOCTYPE html>
<html lang="en">
        <head>
		<title>Login Page</title>
		<link type="text/stylesheet" rel="stylesheet" href="css/layout.css">
	</head>

	<body>
		<div id="wrap">
			<h1>LOGIN</h1>
			<?php if (isset($errors)) { echo $errors; } ?>
			<form method="post" action="login.php">
				<p><label for="username">Username: </label><input type="text" name="username"/></p>
				<p><label for="password">Password: </label><input type="password" name="password"/></p>
				<p><input type="submit" value="Login"/></p>
			</form>
			<p><a href="register.php">If you do not have an account, you are welcome to create one.</a></p>
		</div>
	</body>
</html>
