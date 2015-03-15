<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  return;
}

echo 'hello ';
if (isset($_FILES['file'])){
	//make sure file was uploaded without errors
	echo 'world';
	
	if ($_FILES['file'][['error']] == 0) {
		//Connect to database
		require('connect.php');
		$db = open_connection();
		$email = mysqli_real_escape_string($db, $_SESSION['email']);
		echo $email;
        $query = "select group_num from enrolled_list where student_id = '$email' ";
        $result = mysqli_query($db, $query);
        require('functions.php');
        if (mysqli_num_rows($result) > 0) {
          $group = mysqli_getresult($result, mysqli_num_rows($result), 0);
        } else {
          $group = "no group";
        }
        echo $group;
	}

	$file_name = mysqli_real_escape_string($db, $_FILES['file']['name']);
	$file_type = mysqli_real_escape_string($db, $_FILES['file']['type']);
	$content =  mysqli_real_escape_string($db, file_get_contents(($_FILES['file']['tmp_name'])));
	$file_size = intval($_FILES['file']['size']);
	$datetime = NULL;
	$module = "consumerinformatics";

	$query = "INSERT INTO `report` (`name`, `type`, `size`, `data`, `group`, `uploadtime`, `class`) VALUES('{$file_name}', '${file_type}', '{$file_size}', '{$content}', '{$group}', '{$datetime}', '{$module}')";

	$result = $db->query($query);

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
//link to go back
//echo '<p>Click <a href = "index.php">here</a> to go back </p>';


?>