<?php
  require_once('connect.php');
  require_once('functions.php');
  $db = open_connection();
  $class = mysqli_real_escape_string($db, $_SESSION['class']);
  $email = mysqli_real_escape_string($db, $_SESSION['email']);

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