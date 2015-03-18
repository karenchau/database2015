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
    //get user's group_id
    $query = "SELECT * FROM group_list "; 
    $query .= "WHERE class = '$class' "; 
    $query .= "AND (member1 = '$email' OR member2 = '$email' OR member3 = '$email')";
    $result = mysqli_query($db, $query);
    if (!$result){
        echo 'Query failed : '.mysqli_error($db);
        $db->close();
        exit(0);
    }
    $row = mysqli_fetch_assoc($result);
    $group_id = $row["group_id"];
    
    
    $query="SELECT * FROM thread ORDER BY id DESC"; // OREDER BY id DESC is order result by descending
    $result=mysqli_query($db, $query);

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
        <h1> Group <?php echo $group_id ?> Forum</h1>
      </div>
      
        <table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
            <tr>
                <td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
                <td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
                <td width="53%" align="center" bgcolor="#E6E6E6"><strong>Asked by</strong></td>
                <td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
            </tr> 
            <?php
                // Start looping table row
                while($rows= mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td bgcolor="#FFFFFF"><? echo $rows['id']; ?></td>
                <td bgcolor="#FFFFFF"><a href="viewThread.php?id=<? echo $rows['id']; ?>"><? echo $rows['title']; ?></a><BR></td>
                <td align="center" bgcolor="#FFFFFF"><? echo $rows['email']; ?></td>
                <td align="center" bgcolor="#FFFFFF"><? echo $rows['datetime']; ?></td>
            </tr>
            <?php
                // Exit looping and close connection 
                }
                mysql_close();
            ?>
            <tr>
               <td colspan="5" align="right" bgcolor="#E6E6E6"><a href="createThread.php"><strong>Create New Thread</strong> </a></td>
            </tr>
        </table>
    </div>
  </body>
</html>