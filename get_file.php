<?php
// Make sure an ID was passed
if(isset($_GET['id'])) {
// Get the ID
    $id = $_GET['id'];
    echo "hello";
    echo $id;
 
    // Connect to the database

    $db = open_connection();
    echo 'after connection';
	$id_num = mysqli_real_escape_string($db, $id);
    echo 'after id';
	$query = "SELECT * FROM report where group_id = '$id_num'";
    echo 'after query';
	$result = mysqli_query($db, $query);
    echo 'after result';

    echo "here";

    if($result) {
    	echo "there is a result";
        // Make sure the result is valid
        /*
        if($result->num_rows == 1) {
        	echo 'getting the result row';
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
        */
    } else {
        echo "bye";
        echo "Error! Query failed: <pre>{$db->error}</pre>";
    }
    mysqli_close($db);

    echo "there";
} else {
    echo 'Error! No ID was passed.';
}
?>
