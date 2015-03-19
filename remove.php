<?php
	if (empty($_POST['studentemail2'])) {
		$enroll_errors = "1"; //Error!: Please enter an email.
	} else {
		require_once('connect.php');
		$db = open_connection();
		$student_email = mysqli_real_escape_string($db, $_POST['studentemail2']);
		$class = mysqli_real_escape_string($db, $_POST['c2']);
		$query = "SELECT * from enrolled_list where student_id = '$student_email' and class = '$class' limit 1";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 0) {
			$enroll_errors = "5"; //Error!: This user is not on the roster.
		} else {
			$query2 = "DELETE from enrolled_list where student_id = '$student_email' and class = '$class' ";
			mysqli_query($db, $query2);
		}
		mysqli_close($db);
	}
	if ($enroll_errors) {
		echo json_encode(array('success' => false, 'message_num' => "$enroll_errors")); 
	} else {
		echo json_encode(array('success' => true)); 
	}
	unset($enroll_errors);
?>