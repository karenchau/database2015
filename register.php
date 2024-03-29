<?php
	if (empty($_POST['studentemail'])) {
		$enroll_errors = "1"; //Error!: Please enter an email.
	} else {
		require_once('connect.php');
		$db = open_connection();
		$student_email = mysqli_real_escape_string($db, $_POST['studentemail']);
		$class = mysqli_real_escape_string($db, $_POST['c']);
		$query = "SELECT role from user where email = '$student_email' limit 1";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) == 0) {
			$enroll_errors = "2"; //Error!: This is not a registered user on Platform yet.
		} else {
			$query2 = "SELECT * from enrolled_list where student_id = '$student_email' and class = '$class' ";
			$result2 = mysqli_query($db, $query2);
			if (mysqli_num_rows($result2) > 0) {
				$enroll_errors = "3"; //Error!: This student is already registered for this class.
			} else {
				require_once('functions.php');
				$role = mysqli_getresult($result, mysqli_num_rows($result), 0);
				if ($role) {
					$enroll_errors = "4"; //Error!: You cannot add another admin to this class.
				} else {
					$query3 = "INSERT into enrolled_list(student_id, class) values ('$student_email', '$class')";
					mysqli_query($db, $query3);
				}
			}
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