<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../4427.png">
    <link type='text/css' rel='stylesheet' href='style.css'/>

    <title>User Homepage</title>  
</head>

<body>
    <?php
    $dbhost = 'cy9dfntmir.database.windows.net';
    $dbuser = 'database2015@outlook.com@cy9dfntmir';
    $dbpass = 'Londonn!';
    $dbname = 'Project';
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Could not connect: '. mysql_error());
    if(!$connection) {
        
    }
    ?>

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
    </div>

    <div id="footer">
        Virtual Learning Environment
    </div>
</body>