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
// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        require_once('connect.php');
        $db = open_connection();
        $email = mysqli_real_escape_string($db, $_SESSION['email']);
        $class = mysqli_real_escape_string($db, $_SESSION['class']);
        
        //more than one member in the group 
        $query = "SELECT * FROM group_list "; 
        $query .= "WHERE class = '$class' "; 
        $query .= "AND (member1 = '$email' OR member2 = '$email' OR member3 = '$email')";
        $result = mysqli_query($db, $query);
        
        if (!$result)
        {
            echo 'Query failed : '.mysqli_error($db);
            $db->close();
            exit(0);
        }
        
        
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $group_id = $row["group_id"];
        }
        else{
            echo 'You are not currently in a group';
            mysqli_close($db);
            return;
        }
        
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required file data
        $name = $db->real_escape_string($_FILES['uploaded_file']['name']);
        $type = $db->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $db->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
        $date = date('Y/m/d H:i:s');
        
        //type checking
        if(($type != 'text/plain') && ($type != 'application/xml') && ($type != 'text/xml'))
        {
            echo '<p>Wrong File Type!</p>';
            mysqli_close($db);
            return;
        }
        // Create the SQL query
        $query = " INSERT INTO report VALUES ('$name', '$type', '$size', '$data', '$group_id', '$date' ,'$class')";
        // Execute the query
        $result = mysqli_query($db, $query);
        
        // Check if it was successfull
        if($result) {
            echo '<p>Success! Your file was successfully added!</p>';
        }
        else {
            echo '<p>Error! Failed to insert the file</p> '
               . "<pre>{$db->error}</pre>";
        }
    }
    else {
        echo '<p> An error accured while the file was being uploaded. </p> '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    mysqli_close($db);
}
else {
    echo '<p>Error! A file was not sent!</p>';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="index.php">here</a> to go back</p>';
?>