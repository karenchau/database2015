<p>Hi</p>

<?php
	require('connect.php');
	$db = open_connection();
	$query = "select * from user";
	$result = mysqli_query($db, $query);
	
	require('functions.php');
	print_table($result);
	mysqli_close($db);
?>

<p>end</p>