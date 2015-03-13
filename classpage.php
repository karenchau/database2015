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
        
        <!-- Creating a personalized tab greeting-->
        <title>
        	<?php
        	require('connect.php');
        	$db = open_connection();
        	$email = mysqli_real_escape_string($db, $_SESSION['email']);
        	$query = "select first_name from user where email = '$email' ";
        	$result = mysqli_query($db, $query);
        	require('functions.php');
        	if (mysqli_num_rows($result) > 0) {
        		$fname_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
        		echo "$fname_entry's ";
        	} else {
        		echo "User";
        	}
        	mysqli_close($db);
        	?>
        	Homepage</title>
        
        <!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/main.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">

		<!-- Latest compiled and minified JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
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
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><p class="navbar-btn"><a href="logout.php" class="btn btn-danger">Sign out</a></p></li>
					</ul>
				</div>
			</div>
		</nav>
		
        <div class="container">
			<div class="page-header">
				<!-- Creating a personalized homepage greeting-->
				<h2>Welcome <?php echo "$fname_entry" ?>!</h2> <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!! change this back to h1 if we change style.css -->
			</div>
			<br>
            
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
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Department </strong></span> 
                                	<!-- Checks if the field is NULL for the columns that can be NULL to prevent layout discrepancies -->
                                	<?php echo ($row['department'] == NULL) ? "N/A" : $row['department']; ?></li> 
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Group </strong></span> 
                                	<?php echo ($row['group'] == NULL) ? "N/A" : $row['group']; ?></li>
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Class Year </strong></span> 
                                	<?php echo ($row['year'] == NULL) ? "N/A" : $row['year']; ?></li>
                                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Role </strong></span>
                                	 <?php echo ($row['role'] == "1") ? "Admin" : "Student"; ?></li>
                        </ul>
                        <?php
                            mysqli_close($db);  
                        ?>


                    </ul>
                </div>
                    <!-- right colomn -->
                    <!-- Tabs for navigating the user options-->    
                <div class="container">
                	<ul class="nav nav-tabs">
                		<li class="nav active"><a href="#A" data-toggle="tab">A</a></li>
                		<li class="nav"><a href="#B" data-toggle="tab">B</a></li>
                		<li class="nav"><a href="#C" data-toggle="tab">C</a></li>
                	</ul>

                	<!-- Tab panes -->
                	<div class="tab-content">
                		<div class="tab-pane fade in active" id="A">Content inside tab A</div>
                		<div class="tab-pane fade" id="B">Content inside tab B</div>
                		<div class="tab-pane fade" id="C">Content inside tab C</div>
                	</div>
                </div>

        </div>
    </body>
</html>