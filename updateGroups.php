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
//if add_to_group
//if remove_from_group
//if...
?>
