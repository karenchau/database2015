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
?>