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
  
  <title>Virtual Learning Environment</title>
</head>

<body>
  <div class="header"><h1>
      <?php
        $welcome = "Welcome to Virtual Learning Environment!";
        echo $welcome;
      ?>
    </h1>
  </div>

    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        
        <p><a href="logout.php">Logout link (as an alternative for now)</a></p>
        
        <form action="logout.php" method="post">
                <p><input type="submit" value="logout"></p>
        </form>
      </div>
    </form>
  </body>
</html>

  <!-- Using the session id to make a query and it prints out the welcome message if it worked
      <?php
  /*  require('connect.php');
      $db = open_connection();
      $query = "select * from user where email = " .$_SESSION['email'];
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