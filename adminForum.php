<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: login.php');
  return;
}

if (!isset($_SESSION['class'])) {
  header('Location: index.php');
  return;
}
?>
<?php
    require_once('connect.php');
    require_once('functions.php');
    $db = open_connection();
    $email = mysqli_real_escape_string($db, $_SESSION['email']);
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
?>
<?php
    //Find all group forums for this class
    $query = "SELECT * FROM thread_table ";
    $query .="WHERE class = '$class' ";
    
    $result = mysqli_query($db, $query);
    if (!$result){
        echo 'Query To find the threads failed : '.mysqli_error($db);
        mysqli_close($db);
        exit(0);
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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    
    <title><?php echo $class?> Forum</title>
  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img alt="Virtual Learning Environment" src="3333.png">latform</a>
        </div>        
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><p class="navbar-btn"><a href="logout.php" class="btn btn-danger">Sign out</a></p></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="page-header">
        <h1> Groups Forum</h1>
        <ol class="breadcrumb">
            <li><a href="index.php">Main Page</a></li>
            <li><a href="\studentClassPage.php?classid=".$class."\"> <?php echo $class?></a></li>
            <li class="active">Forum</li>
        </ol>
      </div>
      <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Asked Questions by group </div>
        <!-- Table -->
        <table class="table table-hover">
            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Topic</th>
                        <th>Asked By</th>
                        <th>Group #</th>
                        <th>Date/Time</th>
                    </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $row['id']; ?></th>
                        <td bgcolor="#FFFFFF"><a href="viewThread.php?id=<? echo $row['id']; ?>"><? echo $row['title']; ?></a><BR></td>
                        <td bgcolor="#FFFFFF"><? echo $row['email']; ?></td>
                        <td align="center" bgcolor="#FFFFFF"><? echo $row['id_group']; ?></td>
                        <td align="center" bgcolor="#FFFFFF"><? echo $row['datetime']; ?></td>
                    </tr>
                <?php } ?>
             </tbody>
            
        </table>
        <br>
        <?php
             mysqli_close($db);
        ?>
      </div>
    </div>
  </body>
</html>


