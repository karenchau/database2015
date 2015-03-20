<?php
    session_start();
    if (!isset($_SESSION['email'])) {
      header('Location: login.php');
      return;
    }
    if(!isset($_SESSION['class'])){
        header('Location: index.php');
        return; 
    }
?>
<?php
    require_once('connect.php');
    require_once('functions.php');
    $db = open_connection();
    $admin = mysqli_real_escape_string($db, $_SESSION['email']);
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
?>
<?php
    //get the student's email
    //get the group id
    //insert the new value to the row in the table as that
?>