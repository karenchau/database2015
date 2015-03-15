<html>
	<h3>All students</h3>
	<br>
	<?php
		$db = open_connection();
		$query = "SELECT first_name, last_name, email, department, year from user where role = '0' ";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) > 0) {
			print_table($result);
		} else {
			echo "<p>No one is registered as a student user on platform yet.</p>";
		}
	echo "<br>";
	echo "<h3>All students registered for this class</h3>";
	echo "<br>";
		$query2 = "SELECT student_id from enrolled_list where class = '$_SESSION[class]' ";
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