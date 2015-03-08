<?php
session_start();
if (isset($_SESSION['x'])) {
	header('Location: index.php');
	return;
}
if (isset($_POST['email']) || isset($_POST['password'])) {
	if (empty($_POST['email']) || empty($_POST['password'])) {
		$errors = '<p class="error">Please fill all fields</p>';
	} else {
		require('connect.php');
		$db = open_connection();
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$query = "select * from user where email = '$email' and password = '$password' limit 1";
		$result = mysqli_query($db, $query);	
		
		if (mysqli_num_rows($result) > 0) {
			mysqli_close($db);
			$_SESSION['x'] = $email;
			header('Location: index.php');
			return;
		} else {
			mysqli_close($db);
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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../4427.png">
        <link type='text/css' rel='stylesheet' href='style.css'/>
	</head>

	<body>
		<div id="wrap">
			<header>LOGIN</header>
			<?php if (isset($errors)) { echo $errors; }?>
			<form method="post" action="login.php">
			     <div class="form-group">
			         <p><label for="email">Email</label> 
			         <input type="text" name ="email" placeholder="Enter email"></p>
			     </div>
			      
			     <div class="form-group">
			         <p><label for="password">Password</label> 
			         <input type="password" name="password" placeholder="Enter a password"></p>
			         <p><label class="login"><input type="submit" value="Login"/></label></p>
			     </div>
            </form>
		</div>
	</body>
</html>
