<html>
	<h3>All students registered for this class</h3>
	<br>
	<?php
		$db = open_connection();
		// This nested query first finds all the students enrolled in the class and then uses those results to find their names.
		$query = "SELECT first_name, last_name, email from user where email in (SELECT student_id from enrolled_list where class = '$_SESSION[class]')";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) > 0) {
			print_table($result);
		} else {
			$reg_none_error = "No one is registered for this class yet.";
			echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
		}
		mysqli_close($db);
	?>
	<br>

	<!--<?php
		/*If the admin chooses the enroll option, then it would initiate this if statement
		if (isset($_POST['enrolled'])) {
			$testing = "zzz";
			/*
			if (isset($_POST['studentemail']) || empty($_POST['studentemail'])) {
				$enroll_errors = 'Error!: Please enter an email.';
			} else {
				$student_email = mysqli_real_escape_string($db, $_POST['studentemail']);
				$query = "SELECT * from user where email = '$student_email' limit 1";
				$result = mysqli_query($db, $query);
				if (mysqli_num_rows($result) == 0) {
					$enroll_errors = 'Error!: This student is not registered as a user on Platform yet.';
				} else {

				}
			}
			echo "$enroll_errors";
			unset($enroll_errors); */
		}
		
	?>
-->
	<br>
</html>