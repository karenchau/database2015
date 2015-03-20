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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<h3>All students registered for this class</h3>
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
						if (option["message_num"] == "4") {
						    $("#error4").show().fadeOut(5000); // shows error message # 4
						} else {
						    $("#error").show().fadeOut(5000); // shows general error message
						    }
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
	<div class="alert alert-danger" role="alert" id="error2" style="display: none;">Error!: This is not a registered user on Platform yet.</div>
	<div class="alert alert-danger" role="alert" id="error3" style="display: none;">Error!: This student is already registered for this class.</div>
	<div class="alert alert-danger" role="alert" id="error4" style="display: none;">Error!: You cannot add another admin to this class.</div>
	<div class="alert alert-danger" role="alert" id="error5" style="display: none;">Error!: This user is not on the roster.</div>
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
			<input type="test" class="form-control" id="groupNum" name="groupNum" placeholder="Enter the group number">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-1">Class:</label>
			<input type="text" id="c" name="c" class="form-control" readonly="readonly" placeholder="<?php echo $_SESSION['class']?>" value="<?php echo $_SESSION['class']?>">
		</div>
		<button type="submit" class="btn btn-primary" name="enroll" id="enroll">Enroll</button>
	</form>
	<br>
	<script>
		$(document).ready(function(){
			$('#removeform').on('submit',function(e) {
				$.ajax({
					url:'remove.php',
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
	<form name="removeform" id="removeform">
		<div class="form-group">
			<label class="control-label col-sm-1">Email:</label>
			<input type="email" class="form-control" id="studentemail2" name="studentemail2" placeholder="Enter student's email">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-1">Class:</label>
			<input type="text" id="c2" name="c2" class="form-control" readonly="readonly" placeholder="<?php echo $_SESSION['class']?>" value="<?php echo $_SESSION['class']?>">
		</div>
		<button type="submit" class="btn btn-danger" name="remove" id="remove">Remove</button>
	</form>
</html>
