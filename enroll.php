<html>
	<h3>All students registered for this class</h3>
	<br>
	<?php
		// This nested query first finds all the students enrolled in the class and then uses those results to find their names.
		$query2 = "SELECT first_name, last_name, email from user where email in (SELECT student_id from enrolled_list where class = '$_SESSION[class]')";
		$result2 = mysqli_query($db, $query2);
		if (mysqli_num_rows($result2) > 0) {
			print_table($result2);
		} else {
			$reg_none_error = "No one is registered for this class yet.";
			echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
		}
		mysqli_close($db);
	?>
	<br>
</html>