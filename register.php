<?php
	if (empty($_POST['studentemail'])) {
		$enroll_errors = 'Error!: Please enter an email.';
	} else {
		require_once('connect.php');
		$db = open_connection();
		$student_email = mysqli_real_escape_string($db, $_POST['studentemail']);
		$query = "SELECT * from user where email = '$student_email' limit 1";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 0) {
			$enroll_errors = 'Error!: This student is not registered as a user on Platform yet.';
		} else {
			$query2 = "SELECT * from enrolled_list where email = '$student_email' and class = 'HIS1009' ";
			$result2 = mysqli_query($db, $query2);
			if ($result2) {
				$enroll_errors = 'Error!: This student is already registered for this class.';
			} else {
				//
			}
		}
		mysqli_close($db);
	}
	if ($enroll_errors) {
		echo json_encode(array('success' => false, 'message' => "$enroll_errors")); 
	} else {
		echo json_encode(array('success' => true, 'message' => "successful")); 
	}
	unset($enroll_errors);
?>