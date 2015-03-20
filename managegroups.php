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
    require_once('connect.php');
    require_once('functions.php');
    $db = open_connection();
    $class = mysqli_real_escape_string($db, $_SESSION['class']);
    $email = mysqli_real_escape_string($db, $_SESSION['email']);

    $query = "SELECT group_id, member1, member2, member3 FROM group_list WHERE class = '$class'";
    $all_groups = mysqli_query($db,$query);
    //Get a list of all students in the class and insert into temporary table.
    //$make_temp_students = "CREATE TEMPORARY TABLE t_students (student_id VARCHAR(40) NOT NULL, PRIMARY KEY(student_id))";
    //mysqli_query($db,$make_temp);
    //$insert_temp = "INSERT INTO t_students (student_id) SELECT student_id FROM enrolled_list WHERE class = '$class'";
    //mysqli_query($db,$insert_temp);

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
<?php
    //Select names of students that are not in a group for this class.
    //get names from(list of enrolled students(not in a group))
    $query = "SELECT * FROM user WHERE email IN (SELECT student_id FROM enrolled_list WHERE class ='$class' AND student_id NOT IN (SELECT member1, member2, member3 FROM group_list WHERE class= '$class')";
    $no_group = mysqli_query($db, $query);
    if (mysqli_num_rows($no_group) > 0) {
        print_table($result);
    } else {
        $reg_none_error = "Everyone in this class has been assigned to a group.";
	echo "<div class=\"alert alert-danger\" role=\"alert\">$reg_none_error</div>";
    }
?>

<!-- Display all the avaialable students without a group-->
<!-- Display all the groups with avaiable space -->
<!-- Add an option of creating a group-->

<html>
<!-- Latest compiled and minified JQuery -->
<head>
	<h3>Manage Groups</h3>
</head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<br>
	<script>
	    $(document).ready(function(){
		$('#addToGroup').on('submit',function(e) {
		    $.ajax({
			url:'addToGroup.php',
                        data:$(this).serialize(),
                        type:'POST',
                        success:function(data){
			console.log(data);
			var option = $.parseJSON (data);
			if(option["success"] == true) {
			    $("#success").show().fadeOut(5000); // shows success message
                        } else {
			    if (option["message_num"] == "1") {
				$("#error1").show().fadeOut(5000); // shows error message # 1
			    } else {
				    if (option["message_num"] == "2") {
					$("#error2").show().fadeOut(5000); // shows error message # 2
                                    } else {
					    if (option["message_num"] == "3") {
						$("#error3").show().fadeOut(5000); // shows error message # 3
                                            } else {
						    $("#error").show().fadeOut(5000); // shows general error message
						}
						
					    }
				    }
				}
                            },
			error:function(data){
			$("#error").show().fadeOut(5000); // shows general error message
			}
		    });
                e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
                });
            });
	</script>
	<div class="alert alert-danger" role="alert" id="error1" style="display: none;">Error!: Please enter an email.</div>
	<div class="alert alert-danger" role="alert" id="error2" style="display: none;">Error!: This group is full!</div>
	<div class="alert alert-danger" role="alert" id="error3" style="display: none;">Error!: This student is already in the group you selected!</div>
	<div class="alert alert-danger" role="alert" id="error" style="display: none;">Error!: There is an error with your request.</div>
	<div class="alert alert-success" role="alert" id="success" style="display: none;">Success!</div>
	<br>
	<h3>Add a student to a Group</h3>
	<form name="addToGroup" id="addToGroup">
		<div class="form-group">
			<label class="control-label col-sm-1">Email:</label>
			<input type="email" class="form-control" id="studentemail" name="studentemail" placeholder="Enter student's email">
		</div>
                <div class="form-group">
			<label class="control-label col-sm-1">Group #:</label>
			<input type="text" class="form-control" id="groupNum" name="groupNum" placeholder="Enter the group number">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-1">Class:</label>
			<input type="text" id="c" name="c" class="form-control" readonly="readonly" placeholder="<?php echo $_SESSION['class']?>" value="<?php echo $_SESSION['class']?>">
		</div>
		<button type="submit" class="btn btn-primary" name="add" id="add">Add the group</button>
	</form>
	<br>
	<script>
		$(document).ready(function(){
			$('#removeFromGroup').on('submit',function(e) {
				$.ajax({
					url:'removeFromGroup.php',
					data:$(this).serialize(),
					type:'POST',
					success:function(data){
						console.log(data);
						var option = $.parseJSON (data);
						if(option["success"] == true) {
							$("#success").show().fadeOut(5000); // shows success message
						} else {
							if (option["message_num"] == "1") {
								$("#error1").show().fadeOut(5000); // shows error message # 1
							} else {
								if (option["message_num"] == "5") {
									$("#error5").show().fadeOut(5000); // shows error message # 5
								} else {
									$("#error").show().fadeOut(5000); // shows general error message
								}
							}
						}
					},
					error:function(data){
						$("#error").show().fadeOut(5000); // shows general error message
					}
				});
				e.preventDefault(); //=== To Avoid Page Refresh and Fire the Event "Click"===
			});
		});
	</script>
	<h3>Remove a student from a Group</h3>
	<form name="removeFromGroup" id="removeFromGroup">
		<div class="form-group">
			<label class="control-label col-sm-1">Email:</label>
			<input type="email" class="form-control" id="studentemail2" name="studentemail2" placeholder="Enter student's email">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-1">Group #:</label>
			<input type="text" class="form-control" id="groupNum2" name="groupNum2" placeholder="Enter the group number">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-1">Class:</label>
			<input type="text" id="c2" name="c2" class="form-control" readonly="readonly" placeholder="<?php echo $_SESSION['class']?>" value="<?php echo $_SESSION['class']?>">
		</div>
		<button type="submit" class="btn btn-danger" name="remove" id="remove">Remove</button>
	</form>
</html>

