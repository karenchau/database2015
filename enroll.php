<html>
	<h3>All students</h3>

	<?php
		$db = open_connection();
		$query = "SELECT first_name, last_name, email, department, year from user where role = '0' ";
		$result = mysqli_query($db, $query);
		print_table($result);
		mysqli_close($db);
	?>

	<h3>All students registered for this class</h3>

	
</html>