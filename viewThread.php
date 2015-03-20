<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        return;
    }
    if(!isset($_SESSION['class'])) {
        header('Location: index.php');
        return;
    }
?>
<?php
    require_once('connect.php');
    $db = open_connection();
    $email = mysqli_real_escape_string($db, $_SESSION['email']);
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
    
    // get value of id that sent from address bar 
    $id=$_GET['id'];
    $query="SELECT * FROM thread_table WHERE id='$id'";
    $result= mysqli_query($db, $query);
    $rows= mysqli_fetch_assoc($result);
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="3333.png">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="container">   
        <div class="page-header">
            <!-- Welcome the user-->
        </div>
        <!-- -->
        <div id="read_thread" class="mainbox col-sm-12">
            <div class="panel panel-info">
                    <div class="panel-heading">
                            <div class="panel-title">Posted Thread</div>
                    </div>  
                    <div class="panel-body">
                        
                    </div>
            </div>
        </div>
    </div>
  </body>
</html>
