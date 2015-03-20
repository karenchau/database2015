<?php
session_start();
if (isset($_SESSION['email'])) {
	header('Location: index.php');
	return;
}

//If the user chooses to signin, then this would initiate this if statement
if (isset($_POST['signin'])) {
    if (isset($_POST['email']) || isset($_POST['password'])) {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $signin_errors = 'Error!: Please fill all fields';
		} else {
            require_once('connect.php');
            $db = open_connection();
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
            $query = "select * from user where email = '$email' and password = '$password' limit 1";
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            echo $row;
            $pass = $row['password'];
            echo $pass;
            if (password_verify($_POST['password'],$pass)){
            	mysql_close($db);
                $_SESSION['email'] = $email;
                header('Location: index.php');
                return;
            } else {
            	mysql($db);
            	$signin_errors = print_r($row);//'Invalid credentials. row ' . $row . ' pass ' . $pass;
;
            }
            /*
            if (mysqli_num_rows($result) > 0) {
                    mysql_close($db);
                    $_SESSION['email'] = $email;
                    header('Location: index.php');
                    return;
                } else {
                    mysql_close($db);
                    $signin_errors = 'Invalid credentials.';
                }
                */
            }
	} else {
		unset($signin_errors);
	}
} else if (isset($_POST['signup'])) { //If the user chooses to signup, then this would initiate this if statement
    if (isset($_POST['email']) || isset($_POST['password']) || isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['role'])) {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $signup_errors = 'Please fill all fields.';
		} else {
            require_once('connect.php');
            $db = open_connection();
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $hash = password_hash($_POST['password'],PASSWORD_DEFAULT, ['cost'=>11]);
            //$password = mysqli_real_escape_string($db, $_POST['password']);
            $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
            $role = mysqli_real_escape_string($db, $_POST['role']);
			$query = "select * from user where email = '$email' limit 1";
			$result = mysqli_query($db, $query);
			if (mysql_num_rows($result) > 0) {
				mysqli_close($db);
				$signup_errors = 'A user with this email already exists.';
			} else {
				$query = "insert into user(first_name, last_name, email, password, role) values ('$first_name', '$last_name', '$email', '$hash', '$role')";
				mysqli_query($db, $query);
				$_SESSION['email'] = $email;
				header('Location: index.php');
				mysqli_close($db);
				return;
			}
		}
	} else {
		unset($signup_errors);
	}
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
        <link rel="icon" href="3333.png">
        
        <!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/main.css" rel="stylesheet">

	</head>
	
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"><img alt="Virtual Learning Environment" src="3333.png">latform</a>
				</div>
			</div>
		</nav>
		
		<div class="container">
			<div class="page-header">
				<h1>Welcome <small>Please sign in or sign up</small></h1>
			</div>
			<div id="signinbox" class="mainbox col-sm-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Sign In</div>
					</div>  
					<div class="panel-body">
						<form id="signinform" class="form-horizontal" role="form" method="post" action="login.php">
							<?php if (isset($signin_errors)) { ?>
								<div id="signinalert" class="alert alert-danger">
									<p><?php echo $signin_errors; ?></p>
									<span></span>
								</div>
							<?php } ?>
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="email" placeholder="Please Enter Email">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Please Enter Password">
								</div>
							</div>
							<div class="form-group">
								<!-- Button -->                                        
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signin" name="signin" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Sign In</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div id="signupbox" class="mainbox col-sm-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="panel-title">Sign Up</div>
					</div>  
					<div class="panel-body">
						<form id="signupform" class="form-horizontal" role="form" method="post" action="login.php">
							<?php if (isset($signup_errors)) { ?>
								<div id="signupalert" class="alert alert-danger">
									<p><?php echo $signup_errors; ?></p>
									<span></span>
								</div>
							<?php } ?>
							
							<!-- Email Field-->
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="email" placeholder="Please Enter Email">
								</div>
							</div>
							
							<!-- Password Field-->
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password">
								</div>
							</div>
							
							<!-- First Name Field-->
							<div class="form-group">
								<label for="first_name" class="col-md-3 control-label">First Name</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="first_name" placeholder="Please Enter Your First Name">
								</div>
							</div>
							
							<!-- Last Name Field-->
							<div class="form-group">
								<label for="last_name" class="col-md-3 control-label">Last Name</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="last_name" placeholder="Please Enter Your Last Name">
								</div>
							</div>
							
							<!-- Role Field-->
							<div class="form-group">
								<label for="role" class="col-md-3 control-label">Role</label>
								<div class="col-md-9">
							        <select class="form-control" name="role" id="role">
							          <option value='default'>Select a role</option>
							          <option value='0'>Student</option>
							          <option value='1'>Admin</option>
							        </select>
							    </div>
							</div>
							
							<div class="form-group">
								<!-- Button -->                                        
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" name="signup" type="submit" class="btn btn-danger"><i class="icon-hand-right"></i>Sign Up</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div> 
		<!-- Bootstrap core JavaScript
		================================================== -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

	
</html>
