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
    require_once('functions.php');
    //get group id
    $group_id = find_group($class, $email);
    // get value of id that sent from address bar 
    $id=$_GET['id'];
    $query="SELECT * FROM thread_table WHERE id='$id' AND class = '$class' ";
    $result= mysqli_query($db, $query);
    if(!result){
        echo 'Error! We could not find this thread, it either has been deleted or is temporarily unavailable '.mysqli_error($db);
        mysqli_close($db);
        exit(0);
    }
    $row= mysqli_fetch_assoc($result);
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
            <div class="page-header">
                <h1> Group <?php echo $group_id ?> Forum</h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Main Page</a></li>
                    <li><a href="\studentClassPage.php?classid=".$class."\"> <?php echo $class?></a></li>
                    <li class="mainForum.php">Forum</li>
                    <li class="active"><?php $row['title'];?></li>
                </ol>
            </div>
        </div>
        <!-- The current Thread Question -->
        <div id="read_thread" class="mainbox col-sm-12">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                            <div class="panel-title"><?php $row['title'];?></div>
                    </div>  
                    <div class="panel-body">
                        <?php $row['description'];?>
                    </div>
            </div>
        </div>
        <br>
        <!-- Loop to display all posts for this thread -->
        
        
        <!-- Add New Post Box--->
        
    </div>
  </body>
</html>
