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
    <!-- Here I would get the user's email and the current class's ID
	 Once I have both, I will be able to extract the group's ID
	 Should I add classID as a field in Thread?-->
    <?php
        
    ?>
    
    <div class="container">
	<div class="page-header">
	    <h1>Welcome to your group forum <p><small>Please create a new thread</small></p></h1>
	</div>
	<div id="create_thread" class="mainbox col-md-12">
	    <div class="panel panel-info">
		<div class="panel-heading">
		    <div class="panel-title">Create Thread</div>
		</div>
		<!--Registration Panel -->
		<div class="panel-body">
		    <form id="thread_form" class="form-horizontal" role="form" method="post" action="addThread.php">

			<div class="form-group">
			    <label for="thread_title" class="col-md-1 control-label">Thread Title</label>
			    <div class="col-md-9">
                                <input type="text" class="form-control" name="thread_title" placeholder="Please Enter a Title">
			    </div>
			</div>
			<div class="form-group">
			    <label for="thread_desc" class="col-md-1 control-label">Description</label>
			    <div class="col-md-9">
				<input type="text" class="form-control" name="thread_desc" placeholder="Please Enter Your Question">
			    </div>
			</div>
			<div class="form-group">
			    <!-- Button -->                                        
			    <div class="col-md-offset-1 col-md-3">
                                <button id="btn-creating_topic" name="creating_topic" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> Creating Topic</button>
			    </div>
			</div>
                    </form>
		</div>
	    </div>
        </div>
    </div>
  </body>  
</html>