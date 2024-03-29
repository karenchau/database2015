<?php
function mysqli_getresult($res, $row, $field) { //takes the row (expects only one row since a primary key is used) and prints out all the fields
	$res->data_seek($row); 
	$datarow = $res->fetch_array();
	if($res->field_count == 1) {
		return $datarow[$field];
	} else {
		while($field < $res->field_count) {
			echo $datarow[$field] ."<br>";
			$field++;
		}
	}
}

function print_table($result) {
	$data = array();
	while($row = mysqli_fetch_assoc($result)) {
		$data[] = $row;
	}
	$colNames = array_keys(reset($data));
	echo "<table class=\"table table-hover\">";
	echo "<tr>";
		foreach($colNames as $colName)
		{
			$newcolName = ucfirst(str_replace("_", " ", $colName));
			echo "<th>$newcolName</th>";
		}
	echo "</tr>";
		foreach($data as $row)
		{
			echo "<tr>";
			foreach($colNames as $colName)
			{
				$temp = ($row[$colName] == NULL) ? "N/A" : $row[$colName];
				echo "<td>".$temp."</td>";
			}
			echo "</tr>";
		}
	echo "</table>";
}

function find_class() {
	if(isset($_SESSION['class'])) {
		require_once('connect.php');
		$db = open_connection();
		$class = mysqli_real_escape_string($db, $_SESSION['class']);
		$query = "SELECT subject from class_list where id = '$class' ";
		$result = mysqli_query($db, $query);
		if (mysqli_num_rows($result) > 0) {
			$class_name_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
			return $class_name_entry;
		} else {
			return NULL;
		}
		mysqli_close($db);
	} else {
		return NULL;
	}
}

function find_group($class,$email){
	require_once('connect.php');
	$db = open_connection();

  	//Get user's group number
  	$query = "SELECT group_id FROM group_list WHERE '$email' IN(member1, member2, member3) AND class = '$class'";
	$result = mysqli_query($db, $query);

	if (mysqli_num_rows($result) > 0) {
		$group_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
		return $group_entry;
	} else {
		return NULL;
	}
    mysqli_close($db);
}

function print_error($message, $redirect_page) {
	echo "<div class=\"alert alert-danger\" role=\"alert\">$message</div>";
	if (!is_null($redirect_page)) {
        header("refresh:3; url=$redirect_page");
    }
}

function registration_table() {
	require_once('connect.php');
	$db = open_connection();
	// This nested query first finds all the students enrolled in the class and then uses those results to find their names.
	$query = "SELECT first_name, last_name, email from user where email in (SELECT student_id from enrolled_list where class = '$_SESSION[class]')";
	$result = mysqli_query($db, $query);
	if (mysqli_num_rows($result) > 0) {
		print_table($result);
	} else {
		$reg_none_error = "No one is registered for this class yet.";
		echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
	}
	mysqli_close($db);
}
?>