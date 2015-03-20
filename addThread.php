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
    require_once('functions.php');
    //get group id
    $group_id = find_group($class,$email);
?>

<?php
    //getting data from the form
    $thread_title = $_POST['thread_title'];
    $thread_desc= $_POST['thread_desc'];
    //create date time
    $datetime=date("y/m/d h:i:s");
    
    //create and execute insertion query
    $query = "INSERT INTO thread_table (id_group, title, description, datetime, email) ";
    $query .="VALUES('$group_id', '$thread_title', '$thread_desc', '$datetime', '$email') ";
    $result = mysqli_query($db, $query);
    
    if($result){
        echo "Successful<BR>";
        echo "<a href=mainForum.php>View your topic</a>";
    }
    else {
        echo "ERROR! You could not add a new thread.<br>" .mysqli_error($db);    
    }
    mysqli_close($db);
?>