<?php
	if(!isset($_SESSION['class'])) {
	    header('Location: index.php');
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
	<header>
	  <h3>Manage Groups</h3>
	 </header>
	<?php
	  require_once('connect.php');
	  require_once('functions.php');
	  $db = open_connection();
	  $class = mysqli_real_escape_string($db, $_SESSION['class']);
	  $email = mysqli_real_escape_string($db, $_SESSION['email']);

	  $query = "SELECT group_id, member1, member2 FROM group_list WHERE class = '$class'";
	  $all_groups = mysqli_real_escape_string($db,$query);

	  //Get a list of all students in the class and insert into temporary table.
	  $make_temp = "CREATE TEMPORARY TABLE t_students (student_id VARCHAR(40) NOT NULL, PRIMARY KEY(student_id))";
	  mysqli_query($db,$make_temp);
	  $insert_temp = "INSERT INTO t_students (student_id) SELECT student_id FROM enrolled_list WHERE class = '$class'";
	  mysqli_query($db,$insert_temp);

	  //Get all students who aren't in a group.
	  $query = "SELECT student_id FROM t_students WHERE student_id NOT IN (SELECT member1, member2, member3 FROM group_list WHERE class= '$class')";
	  $no_group = mysqli_query($db, $query);

	  //Get all students who are already in a group.
	  $query = "SELECT student_id FROM enrolled_list WHERE student_id IN (SELECT member1, member2, member3 FROM group_list WHERE class=$'class')";
	  $in_group = mysqli_query($db, $query);

	  //Get all the groups with one or more empty slots
	  $query = "SELECT group_id FROM group_list WHERE NULL IN (member2, member3)"; 
	  $free_groups = mysqli_query($db, $query);

	  mysqli_close($db);
	?>

	<header><h3>Groups</h3></header>
	<?php print_table($all_groups); ?>

	<form action="update_groups.php" method="POST">
    <div class = "form-group">
      <label for="input_group">Select a group to evaluate:</label>
        <select class="form-control" name = "input_group">
          <option value='default'>Select a group</option>
          <!-- Use $result to get group numbers to populate dropdown -->
          <?php
            $db = open_connection();
            $query = "SELECT group_id from report where (group_id in (SELECT id_report_group FROM evaluation WHERE class = '$class' AND id_eval_group = '$group_entry')) AND class = '$class'";
            $result = mysqli_query($db,$query);

            while(list($category) = mysqli_fetch_row($result)){
              $option = '<option value="'.$category.'">'.$category.'</option>';
              echo ($option);
            }

            mysqli_close($db);
          ?>
        </select>
      <br>

  </body>
</html>

