<?php
// Make sure an ID was passed
if(isset($_GET['id'])) {
// Get the ID
    $id = mysqli_real_escape_string($_GET['id']);
 
    // Connect to the database

    //$db = open_connection();
	$id = mysqli_real_escape_string($_GET['id']);
	$query = "SELECT type, name, size, data FROM report where group_id = {$id}";
	$result = mysqli_query($db,$query);

    if($result) {
        // Make sure the result is valid
        if($result->num_rows == 1) {
        // Get the row
            $row = mysqli_fetch_assoc($result);

            // Print headers
            header("Content-Type: ". $row['type']);
            header("Content-Length: ". $row['size']);
            header("Content-Disposition: attachment; filename=". $row['name']);

            // Print data
            echo $row['data'];
        }
        else {
            echo 'Error! No file exists with that ID.';
        }

        // Free the mysqli resources
        @mysqli_free_result($result);
    }
    else {
        echo "Error! Query failed: <pre>{$db->error}</pre>";
    }
    //@mysqli_close($db);

}
else {
    echo 'Error! No ID was passed.';
}
?>
