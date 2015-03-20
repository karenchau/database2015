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
    
    // Get value of thread id
    $id_thread= $_POST['thread_id'];
    
    // get values that sent from form
    $title = $_POST['post_title'];
    $description=$_POST['post_description']; 
    
    $datetime=date("y/m/d H:i:s"); // create date and time
    
    // Insert answer 
    $query = "INSERT INTO post_table (id_thread, title, description, datetime, id_user)";
    $query .="VALUES('$id_thread', '$title', '$description', '$datetime', '$email')";
    $result=mysqli_query($db, $query);
    
    if($result){
        echo "A New Post Was Successfully Added!<BR>";
        echo "<a href='viewThread.php?id=".$id_thread."'>View your post</a>";
    }
    else {
        echo 'Error! New Post could not be added: '.mysqli_error($db);
    }

    // Close connection
    mysql_close();
?>