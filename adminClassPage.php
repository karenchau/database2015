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

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/main.css" rel="stylesheet">
  
  <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script>
  jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
  });
  </script>

  <title>Consumer Informatics (Admin)</title>
  <?php
    if (!$_SESSION['isAdmin']) {
    $adminerror = "You do not have the privileges to view this page.";
    echo "<p>$adminerror</p>";
    header("refresh:5; url=studentClassPage.php");
    return;
    }
  ?>
</head>

  <body>
    <div class = "header">
      <h1>Consumer Informatics</h1>
    </div>
    <div class="tabs">
      <ul class = "tab-links">
        <li><a href ="#announcements" title = "Announcements and Forum" class="active">Announcements and Forum</a></li>
        <li><a href ="#students" title = "Enrolled Students">Enrolled Students</a></li>
        <li><a href ="#groups" title = "Manage Project Groups">Manage Project Groups</a></li>
        <li><a href ="#grades" title = "View Grades and Rankings">View Grades and Rankings</a></li>
      </ul>
  

    <div class="tab-content">
      <div id="announcements" class="tab active">
        <p>announcements and forum here</p>
      </div>

      <div id="students" class="tab">
        <p>enroll students in class, search and browse information of enrolled students</p>
      </div>

      <div id="groups" class="tab">
        <p>create groups, add students to groups, remove students from groups</p>
      </div>

      <div id="grades" class="tab">
        <p>view grades and aggregate rankings of group reports</p>
      </div>

    </div>
  </div>
  </body>
</html>