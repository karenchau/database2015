<?php
function open_connection() {
	$server = 'tcp:cy9dfntmir.database.windows.net';
	$user = 'database2015@outlook.com';
	$password = 'Londonn!';
	$database = 'Project';
	$handle = mysql_connect($server, $user, $password);
	$found = mysql_select_db($database, $handle);
	
	if ($found){
	   echo "FOUND DATABASE";
		return $found;
	} 	
	else {
		die("Database NOT Found");
	}
}
?>