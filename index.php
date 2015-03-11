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

      <!-- Creating a personalized tab greeting-->
      <title>
          <?php
          require('connect.php');
          $db = open_connection();
          $query = "select first_name from user where email = '$_SESSION[email]' ";
          $result = mysqli_query($db, $query);
          if (mysqli_num_rows($result) > 0) {
              $fname_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
              echo "$fname_entry's ";
              mysqli_close($db);
              } else {
                  echo "User";
                  mysqli_close($db);
              }
              ?>
              Homepage</title>  
  </head>

  <body>
      <!-- Creating a personalized homepage greeting-->
      <div id="header">
          <h1>
            <?php
            echo "$fname_entry's ";
            ?>
            Platform</h1>
      </div>

      <div id="nav">
          London<br>
          <?php
            $db = open_connection();
            $query = "select role from user where email = '$_SESSION[email]' ";
            $result = mysqli_query($db, $query);
            $role = mysqli_getresult($result, mysqli_num_rows($result), 0);
            if($role) {                                                           //depending on the role, a different page will appear
              echo "<a href=\"adminClassPage.php\">COMP2015</a><br>";
            } else {
              echo "<a href=\"studentClassPage.php\">COMP3019</a><br>";
              echo "<a href=\"adminClassPage.php\">admin</a><br>";
            }
            $_SESSION['isAdmin'] = $role;
            mysqli_close($db);
            ?>
          <a href="studentClassPage.php">COMP9999</a><br>
          <a href="studentClassPage2.php">COMP4008</a><br>

      </div>

      <div id="section">
          <h1>London</h1>
          <p>
              London is the capital city of England. It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.
          </p>
          <p>
              Standing on the River Thames, London has been a major settlement for two millennia.
          </p>
          <?php 
              function mysqli_getresult($res, $row, $field) { //takes the row (expects only one row since a primary key is used) and prints out all the fields
              $res->data_seek($row); 
              $datarow = $res->fetch_array();
              if($res->field_count == 1) {
                return $datarow[$field];
              } else {
                while($field < $res->field_count) {
                  echo $datarow[$field] ."<br>";
                  $field++;
                }
              }
            }

          $db = open_connection();
          $query = "select * from user where email = '$_SESSION[email]' ";
          $result = mysqli_query($db, $query);
          mysqli_getresult($result, mysqli_num_rows($result), 0);
          $num = mysqli_num_rows($result);
          echo $num;
          mysqli_close($db);
          ?>
          
          <p class="navbar-btn"><a href="logout.php" class="btn btn-danger">Sign out</a></p>
      </div>

      <div id="footer">
          Virtual Learning Environment
      </div>
  </body>
</html>

  <!-- Using the session id to make a query and it prints out the welcome message if it worked
      <?php
  /*  require('connect.php');
      $db = open_connection();
      $query = "select * from user where email = " .$_SESSION[email];
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) > 0) {
        mysqli_close($db);
        $welcome = "Welcome to 3Virtual Learning Environment!";
        echo $welcome;
        return;
      } else {
        mysqli_close($db);
      }
      ?>
  */