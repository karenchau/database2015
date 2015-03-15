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
			$newcolName = ucfirst($colName.str_replace('_', 'a'));
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
		require('connect.php');
		$db = open_connection();
		$class = mysqli_real_escape_string($db, $_SESSION['class']);
		$query = "SELECT subject from class_list where id = '$class' ";
		$result = mysqli_query($db, $query);
		$class_name_entry = mysqli_getresult($result, mysqli_num_rows($result), 0);
		mysqli_close($db);
		return $class_name_entry;
	} else {
		return "No class found";
	}
}
?>