<?php
$file_name = $_FILES['file']['name'];
$finfo = new finfo(FILEINFO_MIME_TYPE);
$file_type = $finfo->file($_FILES['files']['tmp_name']);

$target_directory = "upload/"; 
$target_file = $target_directory . basename(fileName) ; 
$ok=1;

//This is our size condition
if ($uploaded_size > 1000000)  {  
	echo "File size limit exceeded.<br>";  $ok=0;  
}   

//This is our limit file type condition  
if ($file_type !== 'text/plain')) {
	echo "You may only upload .txt files.<br>"; $ok=0;
}  

//Here we check that $ok was not set to 0 by an error 
if ($ok==0)  {
	echo "Your file was not uploaded.";  
}   
//If everything is ok we try to upload it
else  {
	if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target))  {
		echo "The file ". basename(file_name). " has been uploaded";
	} else { 
		echo "There was an error uploading your file.";
	}  
}
?>



<?php
// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
        require('connect.php');
        $db = open_connection();
        $email = mysqli_real_escape_string($db, $_SESSION['email']);
        //group number
        $query = "select group from user where email = '$email'";
        $result = mysqli_query($db, $query);
        $group = mysqli_getresult($result, mysqli_num_rows($result), 0);
        
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }
 
        // Gather all required data
        $name = $db->real_escape_string($_FILES['uploaded_file']['name']);
        $type = $db->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $db->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO `report` (`name`, `type`, `size`, `data`, `group`)
            VALUES ('{$name}', '{$type}', {$size}, '{$data}','{$group}')";
 
        // Execute the query
        $result = $db->query($query);
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$db->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
 
    // Close the mysql connection
    $db->close();
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
echo '<p>Click <a href="index.html">here</a> to go back</p>';
?>