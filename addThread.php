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
    
    //getting data from the form
    $thread_title = $_POST['thread_title'];
    $thread_desc=$_POST['thread_desc'];
    //create date time
    $datetime=date("d/m/y h:i:s");
    
    //get user's group_id
    $query = "SELECT group_id FROM group_list";
    $query .="WHERE class = '$class' ";
    $query .="AND (member1 = '$email' OR member2 = '$email' OR member3 = '$email')";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $group_id = mysqli_getresult($result, mysqli_num_rows($result), 0);
    } else {
      echo "You are not in a group.";
      return;
    }
    
    //create and execute insertion query
    $query="INSERT INTO $thread(id_group, title, description, datetime, email)";
    $query .="VALUES('$group_id', '$thread_title', '$thread_title', '$datetime', '$email')";
    $result = mysqli_query($db, $query);
    
    if($result){
        echo "Successful<BR>";
        echo "<a href=mainForum.php>View your topic</a>";
    }
    else {
            echo "ERROR! You could not add a new thread.";
    }
    mysql_close();
?>