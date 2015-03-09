<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="3333.png">
    <link type='text/css' rel='stylesheet' href='style.css'/>

    <title>
        <?php
        $abc = 'Hi';
        echo $abc;
        require('connect.php');
        $db = open_connection();
        $query = "select first_name from user where email = " .$_SESSION['email'];
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            mysqli_close($db);
            echo $result;
            return;
            } else {
                mysqli_close($db);
            }
            ?>
            Homepage</title>  
</head>

<body>
    <div id="header">
        <h1>Platform</h1>
    </div>

    <div id="nav">
        London<br>
        <a href="studentclasspage.php">COMP2015</a><br>
        <a href="studentclasspage2.php">COMP4008</a><br>

    </div>

    <div id="section">
        <h1>London</h1>
        <p>
            London is the capital city of England. It is the most populous city in the United Kingdom, with a metropolitan area of over 13 million inhabitants.
        </p>
        <p>
            Standing on the River Thames, London has been a major settlement for two millennia, its history going back to its founding by the Romans, who named it Londinium.
        </p>
        <?php
    $dbhost = 'eu-cdbr-azure-north-c.cloudapp.net';
    $dbuser = 'b082b6b1ae51cd';
    $dbpass = 'd0e3a918';
    $dbname = 'platforAJXH8lC9y';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Could not connect: '. mysql_error());
    if(!$connection) {
        mysqli_close($connection);
    } else {
        $query = "select first_name from user where email = 'james@mail.com' ";
        $result = mysqli_query($db, $query);
        echo $result;
        mysqli_close($connection);
    }
    ?>
    </div>

    <div id="footer">
        Virtual Learning Environment
    </div>
</body>