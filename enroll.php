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
		$query = "SELECT a.first_name, a.last_name, b.student_id from user a, enrolled_list b where b.class = '$_SESSION[class]' ";
		$result = mysqli_query($db, $query);
		print_table($result);
		mysqli_close($db);
	?>
	<br>
</html>