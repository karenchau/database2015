<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../4427.png">
  <link type='text/css' rel='stylesheet' href='style.css'/>
  
  <title>Class Page</title>
</head>

  <body>
  
    <div id = "header"><h1>
    <p>Welcome!</p>
    </h1>
    <h3>
      <?php
      $class = "COMP3013"
      $welcome = "Welcome to " . $class;
      echo $welcome;
      ?>
    </h3>
    </div>
  <div id="menu">
    <ul>
      <li><a href ="#" title = "Announcements and Forum" class="active"></a></li>
      <li><a href ="#" title = "Upload Your Report"></a></li>
      <li><a href ="#" title = "Submit Peer Assessments"></a></li>
      <li><a href ="#" title = "Assessments of Your Report"></a></li>
      <li><a href ="#" title = "Your Grades"></a></li>
    </ul>
  </div>

  <div id="main">
    <h1>Announcements and Forum</h1>
    <p>Main Content</p>
  </div>
  </body>
</html>