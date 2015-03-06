<?php
function open_connection() {
	$server = 'cy9dfntmir.database.windows.net';
	$user = 'database2015@outlook.com@cy9dfntmir';
	$password = 'Londonn!';
	$database = 'Project';
	$handle = mysql_connect($server, $user, $password);
	$found = mysql_select_db($database, $handle);
	if ($found){
		return $found;
	} 	
	else {
		die("Database NOT Found");
	}
}
?>