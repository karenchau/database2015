<?php
    session_start();
    if (!isset($_SESSION['email'])) {
      header('Location: login.php');
      return;
    }
    if (!isset($_SESSION['class'])){
        header('Location: index.php');
        return; 
    }
?>
<?php
    //Select names of students that are not in a group for this class.
    //get names from(list of enrolled students(not in a group))
    $query = "SELECT * FROM user WHERE email IN (SELECT student_id FROM enrolled_list WHERE class ='$class' AND student_id NOT IN (SELECT member1, member2, member3 FROM group_list WHERE class= '$class')";
    $no_group = mysqli_query($db, $query);
    if(!$no_group)
    {
        echo 'Error! We could not find avaiable students ' .mysqli_error($db);
        mysqli_close($db);
        return;
    }
?>

<!-- Display all the avaialable students without a group-->
<!-- Display all the groups with avaiable space -->
<!-- Add an option of creating a group-->

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
  </head>
  <body>
    <header>
      <h3>Add to a Groups</h3>
    </header>
    <?php
        while($row= mysqli_fetch_assoc($no_group))
        {
    ?>
    <p> Student:<?php echo $row['email']; ?></p>
    
    <?php
        }
        ?>
  </body>
</html>
