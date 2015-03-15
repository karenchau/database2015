<html>
	<h3>All students</h3>
	<br>
	<?php
		$db = open_connection();
		$query = "SELECT first_name, last_name, email, department, year from user where role = '0' ";
		$result = mysqli_query($db, $query);
		print_table($result);
		mysqli_close($db);
	?>
	<br>
	<h3>All students registered for this class</h3>
	<?php
		$db = open_connection();
		$query = "SELECT student_id from enrolled_list where class = '$_SESSION[class]' ";
		$result = mysqli_query($db, $query);
		print_table($result);
		mysqli_close($db);
	?>
	<br>
</html>