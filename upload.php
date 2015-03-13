<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  return;
}

if (isset($_FILES['file'])){
	//make sure file was uploaded without errors
	/*
	if ($_FILES['file'][['error']] == 0) {
		//Connect to database
		require('connect.php');
		$db = open_connection();
		$email = mysqli_real_escape_string($db, $_SESSION['email']);
        $query = "select group from user where email = '$email' ";
        $result = mysqli_query($db, $query);
        require('functions.php');
        if (mysqli_num_rows($result) > 0) {
          $fname_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
        } else {
          $fname_entry = "User";
        }
	}
	*/

	$file_name = $db->mysql_real_escape_string($_FILES['file']['name']);
	$file_type = $db->mysql_real_escape_string($_FILES['file']['type']);
	$content = $db->mysql_real_escape_string(file_get_contents(($_FILES['file']['tmp_name'])));
	$file_size = intval($_FILES['file']['size']);

	$query = "INSERT INTO 'report'('name', 'type', 'size', 'data', 'group', 'uploadtime')
			VALUES('{$file_name}', '{$file_type}', '{$file_size}', '{content}', '1', NOW())";

	$result = $db->query($query);

	if ($result) {
		echo 'Your file was successfully uploaded.';
	} else {
		echo 'ERROR: failed to insert file.' . "<pre>{$db->error}</pre>";
	}
	else {
		echo 'An error occurred while the file was being uploaded.' . 'Error code: ' . intval($_FILES[file]['error']);
	}
	mysql_close($db);
}
else {
	echo 'Error: A file was not sent';
}

//link to go back
echo '<p>Click <a href = "index.php">here</a> to go back </p>';



/*
if(isset($_FILES['upload']) && $_FILES['userfile']['size]']>0) {

	$file_name = $_FILES['userfile']['name'];
	$file_type = $_FILES['userfile']['type']; //new finfo(FILEINFO_MIME_TYPE);
	$file_type = $finfo->file($_FILES['userfile']['tmp_name']);
	$file_size = $_FILES['userfile']['size'];
	$tmp_name = $_FILES['userfile']['tmp_name'];
	$error = $_FILES['userfile']['error']

	$fp = fopen($tmp_name,'r');
	$content = fread($fp,filesize($tmp_name));
	$content = addslashes($content);
	fclose($fp);

	if (!get_magic_quotes_gpc()) {
		$file_name = addslashes($file_name);
	} 

	include 'library/config.php';
	include 'library/opendb.php';

	$query = "INSERT INTO report(name, size, type, content)";
	"VALUES('$file_name','$file_size','$file_type','$content')";

	mysql_query($query) or die ('Error, query failed');
	include 'library/closedb.php';

	echo "<br>File $file_name uploaded<br>";
}
*/

/*
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
}
*/
?>