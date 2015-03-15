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
        require('connect.php');
        $db = open_connection();
        $email = mysqli_real_escape_string($db, $_SESSION['email']);
        $class = mysqli_real_escape_string($db, $_SESSION['class']);
        printf("%s is the class ", $class);
        
        //group number
        $query = "SELECT * FROM enrolled_list WHERE student_id = '$email' AND class = '$class'";
        $result = $db->query($query);
        
        //get the row, then group number
        $row = mysqli_fetch_assoc($result);
        $group = $row["group_num"];
        printf("Group: %s", $row["group_num"]);
        //check if the user doesn't belong to a group in this class (null)
        
        //if($group == null)
        //{
        //    echo 'Error! You are not in a group';
            //return;
        //}
        
        //if($group == '0')
        //{
        //    printf"Error! You are a lecturer, not a student";
            //header('Location:index.php');
            //return;
        //}
        
        printf("/n /r Repeat Group: %s", $group);
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
        if(($type != 'text/plain') && ($type != 'application/xml'))
        {
            echo '<p>Wrong File Type!</p>';
            return;
        }
        
        // Create the SQL query
        $query = " INSERT INTO report VALUES ('$name', '$type', '$size', '$data', '$group', '$date' ,'$class')";
 
        // Execute the query
        $result = mysqli_query($db, $query);

 
        // Check if it was successfull
        if($result) {
            echo '<p>Success! Your file was successfully added!</p>';
            //return;
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
    $db->close();
}
else {
    echo '<p>Error! A file was not sent!</p>';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="index.php">here</a> to go back</p>';
?>