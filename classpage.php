<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="3333.png">
        
        <title>Class Page</title>
        
        <!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/main.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
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
					<a class="navbar-brand" href="index.php">University College London</a>
				</div>				
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><p class="navbar-btn"><a href="logout.php" class="btn btn-danger">Sign out</a></p></li>
					</ul>
				</div>
			</div>
		</nav>
		
        <div class="container">
			<div class="page-header">
				<h1>Main User Page</h1>
			</div>
			<br>
            <div class="row"> <!-- Allows the profile and the tabs to be on the same level(row) -->
                <div class="col-sm-3">
                    <!--left col-->
                    <ul class="list-group">
                        <?php
                            $db = open_connection();
                            $email = mysqli_real_escape_string($db, $_SESSION['email']);
                            $query = "select * from user where email = '$email' ";
                            $result = mysqli_query($db, $query);
                        ?>
                        <!-- creating the group listing (side profile) -->
                        <ul class="list-group">
                            <li class="list-group-item text-muted" contenteditable="false">Profile</li>
                            
                            <!-- a while loop to display all the information from the db-->
                            <?php $row = mysqli_fetch_assoc($result) ?>
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">First Name</strong></span> <?php echo $row['first_name']; ?></li>
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Last Name </strong></span> <?php echo $row['last_name']; ?></li>
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Email </strong></span> <?php echo $row['email']; ?></li>
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Department </strong></span> <?php echo $row['department']; ?></li>
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Role </strong></span> <?php echo $row['role']; ?></li> 
                        </ul>
                        <?php
                            mysqli_close($db);  
                        ?>


                    </ul>
                </div>
                    <!-- right colomn -->
                    <!-- Tabs for navigating the user options-->    
                    <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="classpage.php">Class List</a></li>
                    <li role="presentation"><a href="profilepage.php">Profile</a></li>
                    <li role="presentation"><a href="forumpage.php">Forum</a></li>
                    </ul>
            </div>
        </div>
    </body>
</html>