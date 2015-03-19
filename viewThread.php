<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        return;
    }
    if(!isset($_SESSION['class'])) {
        header('Location: index.php');
        return;
    }
?>
<?php
    require_once('connect.php');
    $db = open_connection();
    $email = mysqli_real_escape_string($db, $_SESSION['email']);
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
    
    // get value of id that sent from address bar 
    $id=$_GET['id'];
    $query="SELECT * FROM thread_table WHERE id='$id'";
    $result=mysqli_query($db, $query);
    $rows=mysqli_fetch_assoc($result);
?>

<html lang="en">
  <head>
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
    <!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="container">
        
        <div class="page-header">
            <!-- Welcome the user-->
        </div>
        
        <div id="read_thread" class="mainbox col-sm-12">
            <div class="panel panel-info">
                    <div class="panel-heading">
                            <div class="panel-title">Posted Thread</div>
                    </div>  
                    <div class="panel-body">
                        
                    </div>
    </div>
        
    </div>
  </body>
</html>



			
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
									<input type="number" class="form-control" name="role" placeholder="Please Enter 1 (admin) or 0 (stdn)">
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