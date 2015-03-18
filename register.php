<?php
	if (empty($_POST['studentemail'])) {
		$enroll_errors = 'Error!: Please enter an email.';
	} else {
		require_once('connect.php');
		$db = open_connection();
		$student_email = mysqli_real_escape_string($db, $_POST['studentemail']);
		$query = "SELECT * from user where email = 'ttai@mail.com' limit 1";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 0) {
			$enroll_errors = 'Error!: This student is not registered as a user on Platform yet.';
		} else {

		}
	}
	if ($enroll_errors) {
		echo json_encode(array('success' => false)); 
	} else {
		echo json_encode(array('success' => true)); 
	}
	unset($enroll_errors);
?>