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
        $query = "select first_name from user where email = 'james@mail.com' ";
        $result = mysqli_query($db, $query);
        $num = mysqli_num_rows($result);
        echo $num;
        if (mysqli_num_rows($result) > 0) {
            mysqli_close($db);
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
            Standing on the River Thames, London has been a major settlement for two millennia.
        </p>
        <?php 
        function mysqli_result($res, $row, $field=0) { 
            $res->data_seek($row); 
            $datarow = $res->fetch_array(); 
            return $datarow[$field]; 
        }
        
        $db = open_connection();
        $query = "select first_name from user where email = 'james@mail.com' ";
        $result = mysqli_query($db, $query);
        $z = mysqli_result($result, mysqli_num_rows($result));
        echo $z;
        mysqli_close($db);
        ?>
    </div>

    <div id="footer">
        Virtual Learning Environment
    </div>
</body>