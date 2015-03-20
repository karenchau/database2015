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
    $action = mysqli_real_escape_string($db, $_GET['id']);
    if($action == 0 )
    {
        echo 'DEFAULT';
    }
    else{
        if($action == 1 )
        {
            echo 'ADD';
        }
        else{
            if($action == 2)
            {
                echo 'REMOVE';
            }
        }
    }
?>
