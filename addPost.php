<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        return;
    }
    if(!isset($_SESSION['class'])) {
        header('Location: index.php');
        return;
    }
?>
<?php
    require_once('connect.php');
    $db = open_connection();
    $email = mysqli_real_escape_string($db, $_SESSION['email']);
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
    
    // Get value of id that sent from hidden field 
    $id=$_POST['id'];
    
    // get values that sent from form
    $title = $_POST['title'];
    $description=$_POST['description']; 
    
    $datetime=date("y/m/d H:i:s"); // create date and time
    
    // Insert answer 
    $query = "INSERT INTO post_table (id_thread, title, description, datetime, id_user)";
    $query .="VALUES('$id', '$title', '$description', '$datetime', '$email')";
    $result=mysqli_query($db, $query);
    
    if($result){
        echo "Successful<BR>";
        echo "<a href='viewThread.php?id=".$id."'>View your answer</a>";
    }
    else {
        echo "ERROR";
    }
    // Close connection
    mysql_close();
?>