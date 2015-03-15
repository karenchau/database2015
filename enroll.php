<p>Hi</p>

<?php
	$db = open_connection();
	$query = "select * from user";
	$result = mysqli_query($db, $query);
	echo "here";
	require('functions.php');
	print_table($result);
	mysqli_close($db);
?>

<p>changed function</p>