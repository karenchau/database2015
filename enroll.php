<?php
	$db = open_connection();
	$query = "SELECT first_name, last_name, email, department, year from user where role = '0' ";
	$result = mysqli_query($db, $query);
	print_table($result);
	mysqli_close($db);
?>