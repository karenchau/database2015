<?php
	if (isset($_GET['id'])){
		$db = open_connection();
		$id = mysqli_real_escape_string($_GET['id']);
		$query = "SELECT type, name, size, data FROM report where group_id = {$id}";
		$result = mysqli_query($db,$query);

		if ($result) {
			if($result->num_rows == 1) {
				$row = mysqli_fetch_assoc($result);
				header("Content-Type: " . $row['type']);
				header("Content-Length: ") . $row['size']);
				header("Content-Disposition: attachment; filename=") . $row['name'];

				echo $row['data'];
			}
		} else {
			echo 'Error! No file for that group exists.';
		}
		mysqli_close($db);
	} else {
		echo 'Error! No group ID was passed.';
	}
?>