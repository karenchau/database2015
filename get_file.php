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

// Make sure an ID was passed
if(isset($_GET['id'])) {
// Get the ID
    $id = $_GET['id'];
 
    // Connect to the database
    require_once('connect.php');
    $db = open_connection();
	$id_num = mysqli_real_escape_string($db, $id);
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
	$query = "SELECT * FROM report where group_id = '$id_num' AND class = '$class'";
	$result = mysqli_query($db, $query);


    if($result) {
        // Make sure the result is valid
        if(mysqli_num_rows($result) == 1) {
        // Get the row
            $row = mysqli_fetch_assoc($result);
            $type = $row['type'];
            $size = $row['size'];
            $name = $row['name'];

            // Print headers
            header("Content-Type: $type");
            header("Content-Length: $size");
            header("Content-Disposition: attachment; filename=$name");

            // Print data
            echo $row['data'];
        } else {
            echo 'Error! No file exists with that ID.';
        }

        // Free the mysqli resources
        mysqli_free_result($result);

    } else {
        echo "Error! Query failed: <pre>{$db->error}</pre>";
    }
    mysqli_close($db);

} else {
    echo 'Error! No ID was passed.';
}
?>
