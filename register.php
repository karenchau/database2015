<?php
	//$new_student = $_POST['studentemail'];
	if (empty($_POST['studentemail'])) {
		$enroll_errors = 'Error!: Please enter an email.';
	}
	if ($enroll_errors) {
		echo json_encode(array('success' => false)); 
	} else {
		echo json_encode(array('success' => true)); 
	}
?>