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
  <link type='text/css' rel='stylesheet' href='style.css'/>
  
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

  <title>COMP3013</title>
</head>

  <body>
  
    <div class = "header"><h1>
    <p>Welcome to COMP3013</p>
    </h1>
    <h3>
      
    </h3>
    </div>
  <div class="tabs">
    <ul class = "tab-links">
      <li><a href ="#announcements" title = "Announcements and Forum" class="active">Announcements and Forum</a></li>
      <li><a href ="#upload" title = "Upload Your Report">Upload Your Report</a></li>
      <li><a href ="#submit-assessments" title = "Submit Peer Assessments">Submit Peer Assessments</a></li>
      <li><a href ="#your-projects-assessments" title = "Assessments of Your Report">Assessments of Your Report</a></li>
      <li><a href ="#grades" title = "Your Grades">Your Grades</a></li>
    </ul>
  

    <div class="tab-content">
      <div id="announcements" class="tab active">
        <p>announcements and forum here</p>
      </div>

      <div id="upload" class="tab">
        <p>put upload report button here. indicate whether report has been uploaded</p>
        <form action="upload.php" method="post" enctype="multipart/form-data">
          Select a file to upload:
          <input type="file" name="file" size = "50">
          <input type="submit" value="Upload File" name="submit">
        </form>
      </div>

      <div id="submit-assessments" class="tab">
        <p>see reports you have to assess here. assessment form for each report. make it so group can't assess a report more than once</p>
      </div>

      <div id="your-projects-assessments" class="tab">
        <p>view assessments of your reports</p>
      </div>

      <div id="grades" class="tab">
        <p>view your group's grades and ranking</p>
      </div>
    </div>
  </div>
  </body>
</html>