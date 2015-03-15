<html>
	<h3>All students</h3>
	<br>
	<?php
		$db = open_connection();
		$query = "SELECT first_name, last_name, email, department, year from user where role = '0' ";
		$result = mysqli_query($db, $query);
		print_table($result);
	echo "<br>";
	echo "<h3>All students registered for this class</h3>";
		$query2 = "SELECT student_id from enrolled_list where class = 'MATH2001' ";
		$result2 = mysqli_query($db, $query2);
		print_table($result2);
		mysqli_close($db);
		echo "here";
	?>
	<br>
</html>