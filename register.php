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
			$query2 = "SELECT * from enrolled_list where student_id = '$student_email' and class = '$_POST[c]' ";
			$result2 = mysqli_query($db, $query2);
			if (mysqli_num_rows($result2) > 0) {
				$enroll_errors = 'Error!: This student is already registered for this class.';
			} else {
				$zzz = "successful";
			}
		}
		mysqli_close($db);
	}
	if ($enroll_errors) {
		echo json_encode(array('success' => false, 'message' => "$enroll_errors")); 
	} else {
		echo json_encode(array('success' => true, 'message' => "$zzz")); 
	}
	unset($enroll_errors);
?>