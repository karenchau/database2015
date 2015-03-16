<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  return;
}

$_SESSION['class'] = $_GET['classid'];
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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    
    <!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- Creating a personalized tab greeting-->
    <?php
      require('functions.php');
      $class_name_entry = find_class();
    ?>
    <title><?php echo $class_name_entry?> Class</title>
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
        <h1><?php echo $class_name_entry?> Class</h1>
      </div>
      <!-- Prevents students who type in the admin url to access the admin page -->
      <?php
        if (!$_SESSION['isAdmin']) {
          $adminerror = "Error!: You do not have the privileges to view this page. <br>Redirecting to student class page . . .";
          echo "<div class=\"alert alert-danger\" role=\"alert\">$adminerror</div>";
          header("refresh:4; url=studentClassPage.php");
          return;
        }
      ?>
      <div class="col-sm-12">
        <ul class = "nav nav-tabs">
          <li class = "nav active"><a href ="#announcements" data-toggle="tab">Announcements and Forum</a></li>
          <li class="nav"><a href ="#students" data-toggle="tab">Enrolled Students</a></li>
          <li class="nav"><a href ="#groups" data-toggle="tab">Manage Project Groups</a></li>
          <li class="nav"><a href ="#grades" data-toggle="tab">View Grades and Rankings</a></li>
          <li class="nav"><a href ="#allusers" data-toggle="tab">View All Users</a></li>
        </ul>


        <div class="tab-content">
          <div id="announcements" class="tab-pane fade in active">
            <p>announcements and forum here</p>
          </div>

          <div id="students" class="tab-pane fade">
            <?php include("enroll.php");?>
          </div>

          <div id="groups" class="tab-pane fade">
            <p>create groups, add students to groups, remove students from groups</p>
          </div>

          <div id="grades" class="tab-pane fade">
            <p>view grades and aggregate rankings of group reports</p>
          </div>

          <div id="allusers" class="tab-pane fade">
            <?php include("users.php");?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>