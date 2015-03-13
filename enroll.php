<p>Hi</p>

<?php
	require('connect.php');
	$db = open_connection();
	$query = "select * from user where email = '$email' ";
	$result = mysqli_query($db, $query);
	while($row = $result->fetch_array()) {
		echo $row['first_name'] . " " . $row['last_name'];
  		echo "<br />";
  		echo "working";
	}
?>

<p>end</p>