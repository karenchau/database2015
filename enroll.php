<p>Hi</p>

<?php
	$db = open_connection();
	$query = "select first_name, last_name, email, department, year, role from user";
	$result = mysqli_query($db, $query);
	print_table($result);
	mysqli_close($db);
?>

<p>changed function</p>