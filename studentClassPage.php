<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  return;
}

if ($_GET['classid'] == NULL) {
  header('Location: index.php');
  return;
} else {
  $_SESSION['class'] = $_GET['classid'];
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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- Creating a personalized tab greeting-->
    <?php
      require_once('functions.php');
      if (!is_null(find_class())) {
        $class_name_entry = find_class();
      } else {
        $class_name_entry = "Non-existent";
      }
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
        <!-- Prevents invalid input of classes into the url manually -->
        <?php
          if (is_null(find_class())) {
            $classerror = "Error!: This class does not exist. <br>Redirecting to homepage . . .";
            print_error($classerror, "index.php");
            return;
          }
        ?>
        <h1><?php echo $class_name_entry?> Class</h1>
      </div>
      
      <div class="col-sm-12">
        <ul class = "nav nav-tabs">
          <li class = "nav active"><a href ="#announcements" data-toggle="tab">Announcements and Forum</a></li>
          <li class="nav"><a href ="#upload" data-toggle="tab">Upload Term Project Report</a></li>
          <li class="nav"><a href ="#submit-assessments" data-toggle="tab">Submit Peer Assessments</a></li>
          <li class="nav"><a href ="#your-projects-assessments" data-toggle="tab">Assessments of Your Report</a></li>
          <li class="nav"><a href ="#grades" data-toggle="tab">Your Grades</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="announcements" class="tab-pane fade in active">
            <p>announcements and forum here</p>
              <form action="mainForum.php" method="post" enctype="multipart/form-data">
                <div class ="form-group">
                  <input type="submit" class ="btn btn-info" value ="Access Forum" name="submit">
                </div>
              </form>
          </div>
          
          <div id="upload" class="tab-pane fade">
            <header>
              <h3>Report Upload</h3>
            </header>
            <form action="uploading.php" method="post" enctype="multipart/form-data">
              <div class ="form-group">
                <!-- <label for="uploaded_file">Report upload</label> -->
                <p class="help-block">Please note that this is your final submission. No re-uploads are allowed.</p>
                <input type="file" id="uploaded_file" name="uploaded_file"><br>
                <input type="submit" class ="btn btn-primary" value ="Upload File" name="submit">
              </div>
            </form> 
          </div>
          
          <div id="submit-assessments" class="tab-pane fade">
            <?php include_once("evaluation.php");?>
          </div>
          
          <div id="your-projects-assessments" class="tab-pane fade">
            <p>view assessments of your reports</p>
          </div>
          
          <div id="grades" class="tab-pane fade">
            <?php include_once("studentgrade.php");?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>