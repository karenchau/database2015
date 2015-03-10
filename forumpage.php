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
		<link href="css/layout.css" rel="stylesheet">
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
			<ul class="nav nav-tabs">
            <li role="presentation"><a href="classpage.php">Class List</a></li>
            <li role="presentation"><a href="profilepage.php">Profile</a></li>
            <li role="presentation" class="active"><a href="forumpage.php">Forum</a></li>
        </ul>
		</div>

    </body>


</html>