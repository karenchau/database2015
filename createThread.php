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
          <h1> Create New Thread</h1>
          <ol class="breadcrumb">
              <li><a href="index.php">Main Page</a></li>
              <li><a href="\studentClassPage.php?classid=".$class."\"> <?php echo $class?></a></li>
              <li class="mainForum.php">Forum</li>
              <li class="active">Create New Thread</li>
          </ol>
        </div>
        <br>
        <h4>Please Ask a New Question</h4>
        <br>
        <div id="create_thread" class="mainbox col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Create Thread</div>
                </div>
                <!--New Thread Panel -->
                <div class="panel-body">
                    <form id="thread_form" class="form-horizontal" role="form" method="post" action="addThread.php">
                        <div class="form-group">
                            <label for="thread_title" class="col-md-1 control-label">Thread Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="thread_title" placeholder="Please Enter a Title">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <!-- Text area to use for desc -->
                            <label for="thread_desc">Please provide a description of your issue</label>
                            <textarea class="form-control" rows="5" name="thread_desc" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <!-- Button --> 
                            <div class="col-md-1">
                                <button id="btn-creating_topic" name="creating_topic" type="submit" class="btn btn-danger"><i class="icon-hand-right"></i>Create New Thread</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </body>  
</html>