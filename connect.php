<?php
	$server = 'eu-cdbr-azure-north-c.cloudapp.net';
	$user = 'b082b6b1ae51cd';
	$password = 'd0e3a918';
	$database = 'platforAJXH8lC9y';

function open_connection() {
	$connection = mysqli_connect($server, $user, $password, $database);
	if ($connection){
        return $connection;
	} 	
	else {
		die("Database NOT Found");
	}
}

function table_connect($table) {
	$connection = new mysqli_connect($server, $user, $password, $table);
	if ($connection) {
		return $connection;
	}
	else {
		die("MySQL connection failed:" . mysqli_connect_error());
	}
}
?>