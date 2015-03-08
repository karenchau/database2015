<?php
function open_connection() {
	$server = 'eu-cdbr-azure-north-c.cloudapp.net';
	$user = 'b082b6b1ae51cd';
	$password = 'd0e3a918';
	$database = 'platforAJXH8lC9y';
	$connection = mysqli_connect($server, $user, $password, $database);
	if ($connection){
        return $connection;
	} 	
	else {
		die("Database NOT Found");
	}
}
?>