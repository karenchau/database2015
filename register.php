<?php
	if (empty($_POST['studentemail'])) {
		$enroll_errors = 'Error!: Please enter an email.';
		$hasErr = 1;
	} else {
		$student_email = mysqli_real_escape_string($db, $_POST['studentemail']);
		$query = "SELECT * from user where email = '$student_email' limit 1";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 0) {
			$enroll_errors = 'Error!: This student is not registered as a user on Platform yet.';
			$hasErr = 1;
		} else {
			unset($enroll_errors);
			$hasErr = 0;
		}
	}
	if ($hasErr == 1) {
		echo json_encode(array('success' => false)); 
		echo json_encode(array('emailz' => false));
	} else {
		echo json_encode(array('success' => true)); 
	}
	unset($enroll_errors);
?>