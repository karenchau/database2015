<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  return;
}

echo 'hi';
if (isset($_FILES['file'])){
	echo 'filefound';
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

	require('connect.php');
	$db = open_connection();
	$file_name = "test"; //$db->mysql_real_escape_string($_FILES['file']['name']);
	$file_type = "text/plain"; //$db->mysql_real_escape_string($_FILES['file']['type']);
	$content = NULL; //$db->mysql_real_escape_string(file_get_contents(($_FILES['file']['tmp_name'])));
	$file_size = 1; //intval($_FILES['file']['size']);
	$group = 2;
	$datetime = NULL;
	$module = "consumerinformatics";

	$query = "INSERT INTO 'report' ('name', 'type', 'size', 'data', 'group', 'uploadtime', 'class') VALUES('{$file_name}', '{$file_type}', '{$file_size}', '{content}', '{group}', '{datetime}', '{module}'";

	$result = $db->query($query);
	mysql_close($db);
/*
	if ($result) {
		echo "Your file was successfully uploaded.";
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
*/

//link to go back
//echo '<p>Click <a href = "index.php">here</a> to go back </p>';
}

?>