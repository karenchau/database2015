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
    //echo $class;
    $email = mysqli_real_escape_string($db, $_SESSION['email']);
    //echo $email;
    $query = "SELECT group_id, member1, member2, member3 FROM group_list WHERE class = '$class'";
    $all_groups = mysqli_query($db,$query);
    //Get a list of all students in the class and insert into temporary table.
    //$make_temp_students = "CREATE TEMPORARY TABLE t_students (student_id VARCHAR(40) NOT NULL, PRIMARY KEY(student_id))";
    //mysqli_query($db,$make_temp);
    //$insert_temp = "INSERT INTO t_students (student_id) SELECT student_id FROM enrolled_list WHERE class = '$class'";
    //mysqli_query($db,$insert_temp);
    //Select names of students that are not in a group for this class.
    //get names from(list of enrolled students(not in a group))
    $query = "SELECT name FROM user WHERE email IN (SELECT student_id FROM enrolled_list WHERE class ='$class' AND student_id NOT IN (SELECT member1, member2, member3 FROM group_list WHERE class= '$class')";
    $no_group = mysqli_query($db, $query);
    //Get names of all students who are already in a group.
    //get names from(list of enrolled students(in a group))
    $query = "SELECT name FROM user WHERE email IN (SELECT student_id FROM enrolled_list WHERE student_id IN (SELECT member1, member2, member3 FROM group_list WHERE class=$'class'))";
    $in_group = mysqli_query($db, $query);
    //Get all the groups with one or more empty slots
    $query = "SELECT group_id FROM group_list WHERE NULL IN (member2, member3)";
    $free_groups = mysqli_query($db, $query);
    //Get all the groups that are full
    $query = "SELECT group_id FROM group_list WHERE member2 IS NOT NULL AND member3 IS NOT NULL";
    mysqli_close($db);
    if (mysqli_num_rows($all_groups) > 0) {
	print_table($all_groups);
    } else {
	$reg_none_error = "There are no groups in this class yet.";
	echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
    }
?>
    <div class="row">
	<form action="update_groups.php" method="POST">
	   <div class = "form-group">
	      <label for="add_remove">Add or remove a student from a group:</label>
	         <select class="form-control" name="add_remove" id="add_remove">
		    <option value='default'>Select an action</option>
		    <option value='add'>Add a student to a group</option>
		    <option value='remove'>Remove a student from a group</option>
		 </select>
		 <br/>
	   </div>
	</form>
    </div>
    
    <!-- Latest compiled and minified JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
    <script src="http://silviomoreto.github.io/bootstrap-select/javascripts/bootstrap-select.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function(e) {
	$('.add_remove').selectpicker({
		style: 'btn-info',
		size: 4
		});
	});
	</script>
  </body>
</html>

