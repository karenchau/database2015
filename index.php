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
  <link rel="icon" href="../4427.png">
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
        
        <a href="logout.php">Logout link (as an alternative for now)</a>
        <form method="post" action="logout.php">
            <label class="logout"><input name="submit" type="submit" value="logout"></label>
        </form>
      </div>
    </form>
  </body>
</html>